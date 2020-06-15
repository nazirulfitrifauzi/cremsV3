<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\StaffInfo;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 4) { // client
            return view('home');
        } else { //staff
            //attendance check
            $id = auth()->user()->id;
            $today = now()->toDateString();
            $check = Attendance::whereUserId($id)
                ->whereDate('login_at', $today)
                ->exists();

            //stats
            /** attendance */
            $startDate = Carbon::now()->firstOfMonth(); // first day of the month
            $endDate = Carbon::now()->add(1, 'month')->firstOfMonth(); // end of month
            $period = $startDate->diffInDaysFiltered(function (Carbon $date) {  // get working day without weekend -> need to polish to include public holiday
                return !$date->isWeekend();
            }, $endDate);
            $attend = Attendance::whereUser_id(auth()->user()->id)->whereBetween('login_at', [$startDate, $endDate])->count(); // attendance count in current month

            /** leave */
            if (auth()->user()->role == 1 || auth()->user()->role == 3) { // admin or client
                $leave = 0;
            } else {
                $leave = StaffInfo::whereUser_id(auth()->user()->id)->first()->staff_leave->where('year', now()->format('Y'));
            }

            /** claim */
            if (auth()->user()->role == 1 || auth()->user()->role == 3) { // admin or client
                $claim = 0;
            } else {
                $claim = StaffInfo::whereUser_id(auth()->user()->id)->first()->staff_claim->where('year', now()->format('Y'));
            }

            return view('home', compact('check', 'attend', 'period', 'leave', 'claim'));
        }
    }

    public function profile($id)
    {
        $profile = StaffInfo::sortable()->whereUser_id($id)->first();
        return view('profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string',
            'email'     => 'required|email:rfc,dns',
            'ic_no'     => 'required|digits:12',
            'phone'     => 'required|digits_between:10,12',
            'address1'  => 'required|string',
            'postcode'  => 'required|digits:5',
            'city'      => 'required|string',
            'state'     => 'required',
            'avatar'    => Rule::requiredIf($request->user()->avatar == NULL), 'file|mimes:png,jpeg,jpg|max:10000',
        ]);

        if ($request->has('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_name = 'avatar_' . auth()->user()->id . '.' . $avatar->getClientOriginalExtension();
            Storage::disk('custom')->putFileAs('/Avatar', $avatar, $avatar_name);
        }

        if ($request->has('avatar')) {
            User::whereId(auth()->user()->id)->update([
                'name'      => $request->get('name'),
                'email'     => $request->get('email'),
                'phone'     => $request->get('phone'),
                'avatar'    => $avatar_name,
            ]);
        } else {
            User::whereId(auth()->user()->id)->update([
                'name'      => $request->get('name'),
                'email'     => $request->get('email'),
                'phone'     => $request->get('phone'),
            ]);
        }

        $info = StaffInfo::updateOrCreate([
            'user_id'             => auth()->user()->id
        ], [
            'ic_no'               => $request->get('ic_no'),
            'address1'            => $request->get('address1'),
            'address2'            => $request->get('address2'),
            'postcode'            => $request->get('postcode'),
            'city'                => $request->get('city'),
            'state'               => $request->get('state'),
        ]);

        $info->save();

        session()->flash('status', 'Your information successfully updated.');

        return redirect()->route('home');
    }
}

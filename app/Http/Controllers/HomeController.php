<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Profile;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
            $startDate = Carbon::now()->firstOfMonth();
            $endDate = Carbon::now()->add(1, 'month')->firstOfMonth();
            $period = $startDate->diffInDaysFiltered(function (Carbon $date) {
                return !$date->isWeekend();
            }, $endDate);
            $attend = Attendance::whereUser_id(auth()->user()->id)->whereBetween('login_at', [$startDate, $endDate])->count();
            return view('home', compact('check', 'attend', 'period'));
        }
    }

    public function profile($id)
    {
        $profile = Profile::whereUser_id($id)->first();

        $start_work = Carbon::parse("2016-08-15");
        $service_period = $start_work->diffForHumans(['parts' => 4]);
        return view('profile', compact('profile', 'start_work', 'service_period'));
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

        // dd($request->all());

        if ($request->has('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_name = 'avatar_' . auth()->user()->id . '.' . $avatar->getClientOriginalExtension();
            Storage::disk('custom')->putFileAs('/Avatar', $avatar, $avatar_name);
        }

        if ($request->has('avatar')) {
            User::whereId(auth()->user()->id)->update([
                'name'      => $request->get('name'),
                'email'     => $request->get('email'),
                'avatar'    => $avatar_name,
            ]);
        } else {
            User::whereId(auth()->user()->id)->update([
                'name'      => $request->get('name'),
                'email'     => $request->get('email'),
            ]);
        }

        $profile = Profile::updateOrCreate([
            'user_id'             => auth()->user()->id
        ], [
            'ic_no'               => $request->get('ic_no'),
            'phone'               => $request->get('phone'),
            'address1'            => $request->get('address1'),
            'address2'            => $request->get('address2'),
            'postcode'            => $request->get('postcode'),
            'city'                => $request->get('city'),
            'state'               => $request->get('state'),
            'completed'           => 1,
        ]);

        $profile->save();

        session()->flash('status', 'Your profile successfully updated.');

        return redirect()->route('home');
    }
}

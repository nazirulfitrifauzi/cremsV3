<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Profile;
use App\User;
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
        if (auth()->user()->role == 2 || auth()->user()->role == 3) {
            $id = auth()->user()->id;
            $today = now()->toDateString();
            $check = Attendance::whereUserId($id)
                ->whereDate('login_at', $today)
                ->exists();
            return view('home', compact('check'));
        } else {
            return view('home');
        }
    }

    public function profile($id)
    {
        $profile = Profile::whereUser_id($id)->first();
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
        ]);

        $profile->save();

        session()->flash('status', 'Your profile successfully updated.');

        return redirect()->route('home');
    }
}

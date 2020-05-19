<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('pages.attendances.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'       => ['required'],
            'status'        => ['required', 'string'],
            'location'      => ['required', 'string']
        ]);

        $attendance = new Attendance([
            'user_id'       =>  $request->get('user_id'),
            'status'        =>  $request->get('status'),
            'location'      =>  $request->get('location'),
            'remarks'       =>  $request->get('remarks'),
            'login_at'      =>  now()
        ]);

        $attendance->save();
        session()->flash('status', 'Your attendance has successfully updated.');

        return redirect()->route('home');
    }
}

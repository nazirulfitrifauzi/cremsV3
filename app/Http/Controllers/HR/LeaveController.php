<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leave = Leave::where('user_id', auth()->user()->id)->simplePaginate(10);

        return view('pages.hr.leaves.index', compact('leave'));
    }

    public function create()
    {
        return view('pages.hr.leaves.apply');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'reason'            => ['required'],
            'type'              => ['required'],
            'start'             => ['required'],
            'end'               => ['required']
        ]);

        $userId = auth()->user()->id;

        if ($request->has('halfday')) {
            $halfday = '1';

            if ($request->get('am') == '1') {
                $start = $request->get('start') . ' 09:00:00';
                $end = $request->get('end') . ' 13:00:00';

                $n_start = Carbon::createFromFormat('Y-m-d H:i:s', $start);
                $n_end = Carbon::createFromFormat('Y-m-d H:i:s', $end);
            } else if ($request->get('pm') == '1') {
                $start = $request->get('start') . ' 14:00:00';
                $end = $request->get('end') . ' 18:00:00';

                $n_start = Carbon::createFromFormat('Y-m-d H:i:s', $start);
                $n_end = Carbon::createFromFormat('Y-m-d H:i:s', $end);
            }
        } else {
            $halfday = '0';

            $start = $request->get('start');
            $end = $request->get('end');

            $n_start = Carbon::createFromFormat('Y-m-d', $start);
            $n_end = Carbon::createFromFormat('Y-m-d', $end);
        }

        $start = Carbon::parse($request->get('start'));
        $end = Carbon::parse($request->get('end'));
        $days = $start->diffInDays($end);

        if ($request->get('type') == 'AL' && $request->get('halfday') == '1') {
            $c_days = 0.5;
        } else {
            $c_days = $days + 1;
        }

        $staffLeave = new Leave([
            'user_id'           =>  $userId,
            'reason'            =>  $request->get('reason'),
            'type'              =>  $request->get('type'),
            'start'             =>  $n_start,
            'end'               =>  $n_end,
            'halfDay'           =>  $halfday,
            'days'              =>  $c_days,
        ]);

        $staffLeave->save();
        session()->flash('status', 'Your leave application successfully submitted.');

        return redirect()->route('leave.index');
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function calendar()
    {
        $leave = Leave::where('status', '1')->get();
        return view('pages.hr.leaves.calendar', compact('leave'));
    }
}

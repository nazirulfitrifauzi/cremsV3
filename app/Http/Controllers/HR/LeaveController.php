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
        if (auth()->user()->role == '1' || auth()->user()->role == '2') { // admin or hr
            $leave = Leave::sortable()->simplePaginate(10);
        } else { // staff
            $leave = Leave::sortable()->where('user_id', auth()->user()->id)->simplePaginate(10);
        }

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

        if ($request->get('type') == 'HL') {
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
            $start = $request->get('start');
            $end = $request->get('end');

            $n_start = Carbon::createFromFormat('Y-m-d', $start);
            $n_end = Carbon::createFromFormat('Y-m-d', $end);
        }

        $start = Carbon::parse($request->get('start'));
        $end = Carbon::parse($request->get('end'));
        $days = $start->diffInDays($end);

        if ($request->get('type') == 'HL') {
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

    public function update($type, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function approve($id)
    {
        $name = Leave::find($id)->user->name;
        Leave::whereId($id)->update(['status' => 1]);

        session()->flash('status', $name . "'s leave application has been approved.");
        //  Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function reject($id)
    {
        $name = Leave::find($id)->user->name;
        Leave::whereId($id)->update(['status' => 2]);

        session()->flash('error', $name . "'s leave application has been rejected.");
        //  Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function calendar()
    {
        $leave = Leave::where('status', '1')->get();
        return view('pages.hr.leaves.calendar', compact('leave'));
    }
}

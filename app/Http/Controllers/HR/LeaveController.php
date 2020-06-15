<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\LeaveApply;
use App\Models\StaffLeave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == '1' || auth()->user()->role == '2') { // admin or hr
            $leave = LeaveApply::sortable()->simplePaginate(10);
        } else { // staff
            $leave = LeaveApply::sortable()->where('user_id', auth()->user()->id)->simplePaginate(10);
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
            'reason'            => 'required|string',
            'type'              => 'required',
            'halfday'           => 'required_if:type,==,HL',
            'start'             => 'required',
            'end'               => 'required'
        ]);

        $userId = auth()->user()->id;

        if ($request->get('type') == 'HL') {
            if ($request->get('halfday') == 'am') {
                $start = $request->get('start') . ' 09:00:00';
                $end = $request->get('end') . ' 13:00:00';

                $n_start = Carbon::createFromFormat('Y-m-d H:i:s', $start);
                $n_end = Carbon::createFromFormat('Y-m-d H:i:s', $end);
            } else if ($request->get('halfday') == 'pm') {
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

        $staffLeave = new LeaveApply([
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
        $user_id = LeaveApply::find($id)->user_id;
        $name = LeaveApply::find($id)->user->name;
        LeaveApply::whereId($id)->update(['status' => 1]);

        /** updating leave master table */
        $leave_type = LeaveApply::whereId($id)->value('type'); // AL in leave_apply
        $apply = LeaveApply::whereId($id)->value('days'); // day in leave_apply
        $current_leave = StaffLeave::whereUser_id($user_id)->value($leave_type); // leave_master
        $new_leave = $current_leave + $apply;

        StaffLeave::whereUser_id($user_id)->where('year', now()->format('Y'))->update([
            $leave_type               => $new_leave,
        ]);

        /** return response */
        session()->flash('status', $name . "'s leave application has been approved.");
        //  Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function reject($id)
    {
        $name = LeaveApply::find($id)->user->name;
        LeaveApply::whereId($id)->update(['status' => 2]);

        session()->flash('error', $name . "'s leave application has been rejected.");
        //  Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function calendar()
    {
        $leave = LeaveApply::where('status', '1')->get();
        return view('pages.hr.leaves.calendar', compact('leave'));
    }
}

<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\StaffClaim;
use App\Models\StaffInfo;
use App\Models\StaffLeave;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = User::sortable()->whereRole(2)->simplePaginate(10);

        return view('pages.hr.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = StaffInfo::whereUser_id($id)->first();
        $leave = StaffInfo::whereUser_id($id)->first()->staff_leave->where('year', now()->format('Y'));
        $claim = StaffInfo::whereUser_id($id)->first()->staff_claim->where('year', now()->format('Y'));

        return view('pages.hr.staff.show', compact('staff', 'leave', 'claim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'ic_no'         => 'required|digits:12',
            'address1'      => 'required|string',
            'postcode'      => 'required|digits:5',
            'city'          => 'required|string',
            'state'         => 'required',
            'start_work'    => 'required|date',
        ]);

        $start = Carbon::parse($request->get('start_date'));
        $start = new Carbon($start->addYear(1)->year . "-01-01");
        $duration = $start->diffInYears(now());

        if ($duration < 5) {
            $leave = 14;
        } else {
            $leave = 21;
        }

        $user_id = StaffInfo::whereId($id)->value('user_id');

        $info = StaffInfo::updateOrCreate([
            'id'                    => $request->get('id')
        ], [
            'ic_no'                 => $request->get('ic_no'),
            'address1'              => $request->get('address1'),
            'address2'              => $request->get('address2'),
            'postcode'              => $request->get('postcode'),
            'city'                  => $request->get('city'),
            'state'                 => $request->get('state'),
            'start_work'            => $request->get('start_work'),
        ]);

        if (StaffLeave::whereUser_id($user_id)->count() == 0) {
            $leave = new StaffLeave([
                'user_id'               => $user_id,
                'AL'                    => $request->get('AL'),
                'MC'                    => $request->get('MC'),
                'EL'                    => $request->get('EL'),
                'UP'                    => $request->get('UP'),
                'CL'                    => $request->get('CL'),
                'MP'                    => $request->get('MP'),
                'X'                     => $request->get('X'),
                'leave'                 => $leave,
                'year'                  => now()->format('Y'),
            ]);

            $leave->save();
        } else {
            StaffLeave::whereUser_id($user_id)->update([
                'AL'                    => $request->get('AL'),
                'MC'                    => $request->get('MC'),
                'EL'                    => $request->get('EL'),
                'UP'                    => $request->get('UP'),
                'CL'                    => $request->get('CL'),
                'MP'                    => $request->get('MP'),
                'X'                     => $request->get('X'),
                'leave'                 => $leave,
            ]);
        }

        if (StaffClaim::whereUser_id($user_id)->count() == 0) {
            $claim = new StaffClaim([
                'user_id'               => $user_id,
                'CLM'                   => $request->get('CLM'),
                'CLO'                   => $request->get('CLO'),
                'year'                  => now()->format('Y'),
            ]);

            $claim->save();
        } else {
            StaffClaim::whereUser_id($user_id)->update([
                'CLM'                   => $request->get('CLM'),
                'CLO'                   => $request->get('CLO'),
            ]);
        }

        $info->save();

        session()->flash('status', 'Staff information successfully updated.');

        return redirect()->route('staff.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

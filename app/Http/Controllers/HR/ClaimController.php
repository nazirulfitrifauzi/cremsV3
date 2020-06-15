<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\ClaimApply;
use App\Models\StaffClaim;
use Illuminate\Http\Request;
use Storage;

class ClaimController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == '1' || auth()->user()->role == '2') { // admin or hr
            $claim = ClaimApply::sortable()->simplePaginate(10);
        } else { // staff
            $claim = ClaimApply::sortable()->where('user_id', auth()->user()->id)->simplePaginate(10);
        }

        return view('pages.hr.claims.index', compact('claim'));
    }

    public function create()
    {
        return view('pages.hr.claims.apply');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type'          => 'required',
            'amount'        => 'required|numeric|between:1,10000.00',
            'attachment'    => 'required|file|mimes:png,jpeg,jpg,pdf|max:10000',
        ]);

        $cmonth       = now()->format('M');
        $cyear        = now()->year;
        $runningno = ClaimApply::orderBy('id', 'desc')->limit(1)->first();

        if (!$runningno) {
            $newrunningno = sprintf('%09d', 0 + 1);
        } else {
            $newrunningno = sprintf('%09d', $runningno->id + 1);
        }

        $attachment = $request->file('attachment');
        $refno        = 'CLA/' . strtoupper($cmonth) . $cyear . '/' . $newrunningno . '.' . $attachment->getClientOriginalExtension();
        $attachment_name = $newrunningno . '.' . $attachment->getClientOriginalExtension();
        Storage::disk('custom')->putFileAs('/CLA' . '/' . strtoupper($cmonth) . $cyear, $attachment, $attachment_name);

        $staffClaim = new ClaimApply([
            'user_id'           =>  auth()->user()->id,
            'type'              =>  $request->get('type'),
            'attachment'        =>  $refno,
            'amount'            =>  $request->get('amount'),
        ]);

        $staffClaim->save();
        session()->flash('status', 'Your claim application successfully submitted.');

        return redirect()->route('claim.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function approve($id)
    {
        $user_id = ClaimApply::find($id)->user_id;
        $name = ClaimApply::find($id)->user->name;
        ClaimApply::whereId($id)->update(['status' => 1]);

        /** updating leave master table */
        $claim_type = ClaimApply::whereId($id)->value('type'); // CLM or CLO in claim_apply
        $apply = ClaimApply::whereId($id)->value('amount'); // day in claim_apply
        $current_claim = StaffClaim::whereUser_id($user_id)->value($claim_type); // claim_master
        $new_claim = $current_claim + $apply;

        StaffClaim::whereUser_id($user_id)->where('year', now()->format('Y'))->update([
            $claim_type               => $new_claim,
        ]);

        /** return response */
        session()->flash('status', $name . "'s claim application has been approved.");
        //  Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function reject($id)
    {
        $name = ClaimApply::find($id)->user->name;
        ClaimApply::whereId($id)->update(['status' => 2]);

        session()->flash('error', $name . "'s claim application has been rejected.");
        //  Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy($id)
    {
        //
    }
}

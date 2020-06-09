<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;
use Storage;

class ClaimController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == '1' || auth()->user()->role == '2') { // admin or hr
            $claim = Claim::sortable()->simplePaginate(10);
        } else { // staff
            $claim = Claim::sortable()->where('user_id', auth()->user()->id)->simplePaginate(10);
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
            'attachment'    => 'required|file|mimes:png,jpg,pdf|max:10000',
        ]);

        $cmonth       = now()->format('M');
        $cyear        = now()->year;
        $runningno = Claim::orderBy('id', 'desc')->limit(1)->first();

        if (!$runningno) {
            $newrunningno = sprintf('%09d', 0 + 1);
        } else {
            $newrunningno = sprintf('%09d', $runningno->id + 1);
        }

        $attachment = $request->file('attachment');
        $refno        = 'CLA/' . strtoupper($cmonth) . $cyear . '/' . $newrunningno . '.' . $attachment->getClientOriginalExtension();
        $attachment_name = $newrunningno . '.' . $attachment->getClientOriginalExtension();
        Storage::disk('custom')->putFileAs('/CLA' . '/' . strtoupper($cmonth) . $cyear, $attachment, $attachment_name);

        $staffClaim = new Claim([
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
        $name = Claim::find($id)->user->name;
        Claim::whereId($id)->update(['status' => 1]);

        session()->flash('status', $name . "'s claim application has been approved.");
        //  Return response
        return response()->json([
            'success' => true,
        ]);
    }

    public function reject($id)
    {
        $name = Claim::find($id)->user->name;
        Claim::whereId($id)->update(['status' => 2]);

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

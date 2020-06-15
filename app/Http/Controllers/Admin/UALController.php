<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UAL;
use Illuminate\Http\Request;

class UALController extends Controller
{

    public function index()
    {
        $uals = UAL::all();

        return view('pages.ual.index', compact('uals'));
    }

    public function create()
    {
        return view('pages.ual.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:50',
        ]);

        $ual = new UAL([
            'title'             => $request->get('title'),
            'description'       => $request->get('description'),
            'staff'             => ($request->missing('staff')) ? 0 : 1,
            'attendances'       => ($request->missing('attendances')) ? 0 : 1,
            'leaves'            => ($request->missing('leaves')) ? 0 : 1,
            'claims'            => ($request->missing('claims')) ? 0 : 1,
            'ual'               => ($request->missing('ual')) ? 0 : 1,
        ]);

        $ual->save();

        return redirect()->route('ual.index')->withStatus('User Access Level successfully created.');
    }

    public function show($id)
    {
        $ual = UAL::whereId($id)->first();
        return view('pages.ual.show', compact('ual'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        UAL::whereId($id)->update([
            'staff'             => ($request->missing('staff')) ? 0 : 1,
            'attendances'       => ($request->missing('attendances')) ? 0 : 1,
            'leaves'            => ($request->missing('leaves')) ? 0 : 1,
            'claims'            => ($request->missing('claims')) ? 0 : 1,
            'ual'               => ($request->missing('ual')) ? 0 : 1,
        ]);

        return redirect()->route('ual.index')->withStatus('User Access Level successfully updated');
    }

    public function destroy($id)
    {
        UAL::whereId($id)->delete();
        return redirect()->route('ual.index')->withStatus('User Access Level successfully deleted');
    }
}

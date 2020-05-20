<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::all();

        return view('pages.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('pages.roles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:50',
        ]);

        $role = new Role([
            'title'             => $request->get('title'),
            'description'       => $request->get('description'),
            'attendances'       => ($request->missing('attendances')) ? 0 : 1,
            'leaves'            => ($request->missing('leaves')) ? 0 : 1,
            'claims'            => ($request->missing('claims')) ? 0 : 1,
            'roles'             => ($request->missing('roles')) ? 0 : 1,
        ]);

        $role->save();

        return redirect()->route('roles.index')->withStatus('Role successfully created.');
    }

    public function show($id)
    {
        $role = Role::whereId($id)->first();
        return view('pages.roles.show', compact('role'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        Role::whereId($id)->update([
            'attendances'       => ($request->missing('attendances')) ? 0 : 1,
            'leaves'            => ($request->missing('leaves')) ? 0 : 1,
            'claims'            => ($request->missing('claims')) ? 0 : 1,
            'roles'             => ($request->missing('roles')) ? 0 : 1,
        ]);

        return redirect()->route('roles.index')->withStatus('Role successfully updated');
    }

    public function destroy($id)
    {
        Role::whereId($id)->delete();
        return redirect()->route('roles.index')->withStatus('Role successfully deleted');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $user = User::sortable()->where('active', 0)->simplePaginate(10);
        $role = Role::all();

        return view('pages.request.index', compact('user', 'role'));
    }

    public function update($id, Request $request)
    {
        $active = $request->get('active');
        $role = $request->get('role');
        $active = $request->get('active');

        if ($active == 1) {
            $name = User::find($id)->name;
            User::whereId($id)->update(['role' => $role, 'active' => $active]);

            session()->flash('status', $name . "'s request has been approved.");
        } elseif ($active == 2) {
            $name = User::find($id)->name;
            User::whereId($id)->update(['active' => $active]);

            session()->flash('error', $name . "'s request has been rejected.");
        }

        //  Return response
        return response()->json([
            'success' => true,
        ]);
    }
}

<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        return view('pages.hr.leaves.index');
    }

    public function calendar()
    {
        return view('pages.hr.leaves.calendar');
    }
}

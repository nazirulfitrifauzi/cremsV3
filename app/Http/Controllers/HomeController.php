<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 2 || auth()->user()->role == 3) {
            $id = auth()->user()->id;
            $today = now()->toDateString();
            $check = Attendance::whereUserId($id)
                ->whereDate('login_at', $today)
                ->exists();
            return view('home', compact('check'));
        } else {
            return view('home');
        }
    }
}

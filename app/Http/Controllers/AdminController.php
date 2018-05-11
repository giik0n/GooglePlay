<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Autobuses;
use App\Models\Booking;
use App\Models\Cities;
use App\Models\Drivers;
use App\Models\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admins.index',compact('admins'));
    }
}
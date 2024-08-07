<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function index()
    {
        return view('dashboard', ['msg' => 'Admin dashboard']);
    }

    public function courses()
    {
        return view('dashboard', ['msg' => 'Admin courses page']);
    }

    public function users()
    {
        return view('dashboard', ['msg' => 'Admin users page']);
    }
}

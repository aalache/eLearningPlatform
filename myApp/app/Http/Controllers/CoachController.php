<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        return view('dashboard', ['msg' => 'instructor dashboard']);
    }

    public function courses()
    {
        return view('dashboard', ['msg' => 'instructor courses page']);
    }
}

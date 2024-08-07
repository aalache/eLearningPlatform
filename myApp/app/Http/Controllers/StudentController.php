<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard', ['msg' => 'student dashboard']);
    }

    public function enrollement()
    {
        return view('dashboard', ['msg' => 'student enrollement page']);
    }

    public function courses()
    {
        return view('dashboard', ['msg' => 'student courses page']);
    }
}

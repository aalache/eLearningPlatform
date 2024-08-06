<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function studentHome()
    {
        return view('contact', ['msg' => 'I am a student']);
    }

    public function instructorHome()
    {
        return view('contact', ['msg' => 'I am a instructor']);
    }

    public function adminHome()
    {
        return view('contact', ['msg' => 'I am admin']);
    }
}

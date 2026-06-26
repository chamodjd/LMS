<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function course()
    {
        return view('course');
    }

    public function course_details()
    {
        return view('course_details');
    }

    public function instructor()
    {
        return view('instructor');
    }

    public function ins_details()
    {
        return view('ins_details');
    }

    public function pricing()
    {
        return view('pricing');
    }

}

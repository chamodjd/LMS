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

    public function contact()
    {
        return view('contact');
    }

    public function contactSend(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $to      = 'example@gmail.com';
        $subject = $request->subject;
        $body    = "From: " . $request->name . "\n" .
            "Email: " . $request->email . "\n" .
            "Message: " . $request->message;
        $headers = "From: " . $request->email;

        mail($to, $subject, $body, $headers);

        return response()->json(['message' => 'Message sent successfully!']);
    }

}

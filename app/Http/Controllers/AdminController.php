<?php

namespace App\Http\Controllers;

use App\Models\Student;   // <-- this line is likely missing
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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


    public function dashboard()
    {
        $students = Student::all();
        $recentStudents = Student::orderBy('id', 'desc')->take(5)->get();
        $totalStudents = Student::count();
        $stdCount = Student::where('reg_no', 'like', 'STD%')->count();
        $avgAge = round(Student::avg('age'));
        $avgWeight = round(Student::avg('weight'));

        return view('admin_dashboard', compact(
            'students', 'recentStudents', 'totalStudents',
            'stdCount', 'avgAge', 'avgWeight'
        ));
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:teacher,student',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        return back()->with('message', ucfirst($data['role']) . ' account created.');
    }

    public function destroyUser(User $user)
    {
        if ($user->role !== 'admin') $user->delete();
        return back()->with('message', 'Account deleted.');
    }

}

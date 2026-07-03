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


        return view('admin_dashboard', compact(
            'students', 'recentStudents', 'totalStudents',
            'stdCount',
        ));
    }


    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:teacher,student',
            'address' => 'required_if:role,student|string|max:255',
            'dob' => 'required_if:role,student|date',
            'degree' => 'required_if:role,student|in:Computer Science,Software Engineering',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        if ($data['role'] === 'student') {
            // Prefix per subject: CS for Computer Science, SE for Software Engineering
            $prefix = $data['degree'] === 'Computer Science' ? 'CS' : 'SE';

            // Count only students already in that same degree, so numbering is separate per subject
            $countInDegree = Student::where('degree', $data['degree'])->count();
            $regNo = $prefix . str_pad($countInDegree + 1, 3, '0', STR_PAD_LEFT); // e.g. CS001, SE014

            Student::create([
                'user_id' => $user->id,
                'reg_no' => $regNo,
                'name' => $data['name'],
                'address' => $data['address'],
                'dob' => $data['dob'],
                'degree' => $data['degree'],
            ]);
        }

        return redirect()->route('admin.dashboard')->with('message', ucfirst($data['role']) . ' account created' . ($data['role'] === 'student' ? " (Reg No: {$regNo})" : '') . '.');
    }

}

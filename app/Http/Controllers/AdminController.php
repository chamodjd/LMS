<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
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
        $accounts = User::where('role', '!=', 'admin')->orderBy('role')->orderBy('name')->get();
        $instructors = Instructor::all();
        $totalInstructors = Instructor::count();
        $totalCourses = Course::count();
        $courses = Course::all();

        return view('admin_dashboard', compact(
            'students', 'recentStudents', 'totalStudents',
            'stdCount', 'accounts', 'instructors','totalInstructors','totalCourses', 'courses'
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
            'degree' => 'required_if:role,student|string|max:150',
            'mobile_no' => 'required_if:role,teacher|string|max:20',
            'hire_date' => 'required_if:role,teacher|date',
            'salary' => 'required_if:role,teacher|numeric|min:0',
            'department' => 'required_if:role,teacher|string|max:100',
            'qualification' => 'required_if:role,teacher|string|max:150',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        if ($data['role'] === 'student') {
            $prefix = $data['degree'] === 'Computer Science' ? 'CS' : 'SE';
            $countInDegree = Student::where('degree', $data['degree'])->count();
            $regNo = $prefix . str_pad($countInDegree + 1, 3, '0', STR_PAD_LEFT);

            Student::create([
                'user_id' => $user->id,
                'reg_no' => $regNo,
                'name' => $data['name'],
                'address' => $data['address'],
                'dob' => $data['dob'],
                'degree' => $data['degree'],
            ]);
        }

        if ($data['role'] === 'teacher') {
            $countInstructors = Instructor::count();
            $empNo = 'EMP' . str_pad($countInstructors + 1, 3, '0', STR_PAD_LEFT);

            Instructor::create([
                'user_id' => $user->id,
                'emp_no' => $empNo,
                'name' => $data['name'],
                'mobile_no' => $data['mobile_no'],
                'hire_date' => $data['hire_date'],
                'salary' => $data['salary'],
                'department' => $data['department'],
                'qualification' => $data['qualification'],
            ]);
        }

        return back()->with('message', ucfirst($data['role']) . ' account created.');
    }

    public function studentsPage()
    {
        $students = Student::all();

        return view('admin_students', compact('students'));
    }

    public function instructorsPage()
    {
        $instructors = Instructor::all();

        return view('admin_instructor', compact('instructors'));
    }
    public function coursesPage()
    {
        $courses = Course::all();

        return view('admin_courses', compact('courses'));
    }

    public function storeCourse(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Course::create($data);

        return back()->with('message', 'Course added.');
    }

}

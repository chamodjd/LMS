<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teacherDashboard()
    {
        $students = Student::all();
        $recentStudents = Student::orderBy('id', 'desc')->take(5)->get();
        $totalStudents = Student::count();
        $avgAge = round(Student::avg('age'));
        return view('teacher_dashboard', compact('students', 'recentStudents', 'totalStudents', 'avgAge'));
    }
}

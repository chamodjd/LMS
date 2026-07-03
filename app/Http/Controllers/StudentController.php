<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentDashboard()
    {
        $student = Student::orderBy('id', 'desc')->first();
        return view('student_dashboard', compact('student'));
    }
}

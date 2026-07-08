<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
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
            $words = preg_split('/\s+/', trim($data['degree']));

            if (count($words) === 1) {
                $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $words[0]), 0, 3));
            } else {
                $prefix = '';
                foreach ($words as $word) {
                    $prefix .= strtoupper(substr($word, 0, 1));
                }
            }

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

            $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $data['department']), 0, 3));


            $countInDept = Instructor::where('department', $data['department'])->count();
            $empNo = $prefix . str_pad($countInDept + 1, 3, '0', STR_PAD_LEFT);

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
        $courses = Course::all();

        return view('admin_students', compact('students', 'courses'));
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

    public function updateStudent(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'degree' => 'required|string|max:150',
        ]);

        $student->update($data);

        return back()->with('message', 'Student updated.');
    }

    public function destroyStudent(Student $student)
    {
        $student->delete();

        return back()->with('message', 'Student deleted.');
    }

    public function updateCourse(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $course->update($data);

        return back()->with('message', 'Course updated.');
    }

    public function destroyCourse(Course $course)
    {
        $course->delete();

        return back()->with('message', 'Course deleted.');
    }

    public function updateInstructor(Request $request, Instructor $instructor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'mobile_no' => 'required|string|max:20',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric|min:0',
            'department' => 'required|string|max:100',
            'qualification' => 'nullable|string|max:150',
        ]);

        $instructor->update($data);

        return back()->with('message', 'Instructor updated.');
    }

    public function destroyInstructor(Instructor $instructor)
    {
        $instructor->delete();

        return back()->with('message', 'Instructor deleted.');
    }


    public function importStudents(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('excel_file');
        $handle = fopen($file->getRealPath(), 'r');
        fgetcsv($handle); // skip header row

        while (($row = fgetcsv($handle)) !== false) {
            Student::create([
                'reg_no'  => $row[0],
                'name'    => $row[1],
                'address' => $row[2],
                'dob'     => $row[3],
                'degree'  => $row[4],
            ]);
        }
        fclose($handle);

        return redirect()->route('admin.students')->with('success', 'Students imported successfully!');
    }

    public function exportStudentsPdf(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $students = Student::where('name', 'like', "%{$search}%")
                ->orWhere('reg_no', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('degree', 'like', "%{$search}%")
                ->get();
        } else {
            $students = Student::all();
        }

        $pdf = Pdf::loadView('admin_student_pdf', compact('students'));

        $exportPath = public_path('exports');
        if (!file_exists($exportPath)) {
            mkdir($exportPath, 0755, true);
        }

        $pdf->save($exportPath . '/students.pdf');

        return view('admin_student_pdf', compact('students'));
    }

    public function importInstructors(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('excel_file');
        $handle = fopen($file->getRealPath(), 'r');
        fgetcsv($handle); // skip header row

        while (($row = fgetcsv($handle)) !== false) {
            Instructor::create([
                'emp_no'        => $row[0],
                'name'          => $row[1],
                'mobile_no'     => $row[2],
                'hire_date'     => $row[3],
                'salary'        => $row[4],
                'department'    => $row[5],
                'qualification' => $row[6],
            ]);
        }
        fclose($handle);

        return redirect()->route('admin.instructors')->with('message', 'Instructors imported successfully!');
    }

    public function exportInstructorsPdf(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $instructors = Instructor::where('name', 'like', "%{$search}%")
                ->orWhere('emp_no', 'like', "%{$search}%")
                ->orWhere('department', 'like', "%{$search}%")
                ->orWhere('qualification', 'like', "%{$search}%")
                ->get();
        } else {
            $instructors = Instructor::all();
        }

        $pdf = Pdf::loadView('admin_instructor_pdf', compact('instructors'));

        $exportPath = public_path('exports');
        if (!file_exists($exportPath)) {
            mkdir($exportPath, 0755, true);
        }

        $pdf->save($exportPath . '/instructors.pdf');

        return view('admin_instructor_pdf', compact('instructors'));
    }

    public function exportCoursesPdf(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $courses = Course::where('name', 'like', "%{$search}%")->get();
        } else {
            $courses = Course::all();
        }

        $pdf = Pdf::loadView('admin_course_pdf', compact('courses'));

        $exportPath = public_path('exports');
        if (!file_exists($exportPath)) {
            mkdir($exportPath, 0755, true);
        }

        $pdf->save($exportPath . '/courses.pdf');

        return view('admin_course_pdf', compact('courses'));
    }

}

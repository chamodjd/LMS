<?php

namespace App\Http\Controllers;

use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\CourseModule;
use App\Models\ModuleExam;
use App\Models\ModuleTopic;
use App\Models\ModuleAssignment;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function teacherDashboard()
    {
        $instructor = Auth::user()->instructor;

        $totalStudents = Student::count();
        $totalCourses = $instructor ? CourseModule::where('instructor_id', $instructor->id)->distinct('course_id')->count('course_id') : 0;
        $totalAssignments = $instructor ? ModuleAssignment::whereHas('module', function ($q) use ($instructor) {
            $q->where('instructor_id', $instructor->id);
        })->count() : 0;

        return view('teacher_dashboard', compact('totalStudents', 'totalCourses', 'totalAssignments'));
    }

    public function myModules()
    {
        $instructor = Auth::user()->instructor;
        $modules = CourseModule::where('instructor_id', $instructor->id)->with('course')->get();

        return view('teacher_modules', compact('modules'));
    }

    public function moduleDetail(CourseModule $module)
    {
        $instructor = Auth::user()->instructor;

        if (!$instructor || $module->instructor_id !== $instructor->id) {
            abort(403, 'You are not assigned to this module.');
        }

        $module->load(['topics', 'assignments.submissions', 'exams.questions', 'course']);

        return view('teacher_module_detail', compact('module'));
    }

    public function storeTopic(Request $request, CourseModule $module)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:20480',
        ]);

        $data = [
            'course_module_id' => $module->id,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $module->topics()->count() + 1,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_path'] = $file->store('topic_files', 'public');
            $data['original_name'] = $file->getClientOriginalName();
        }

        ModuleTopic::create($data);

        return back()->with('message', 'Topic added.');
    }

    public function storeAssignment(Request $request, CourseModule $module)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'file' => 'nullable|file|max:20480',
        ]);

        $data = [
            'course_module_id' => $module->id,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_path'] = $file->store('assignment_files', 'public');
            $data['original_name'] = $file->getClientOriginalName();
        }

        ModuleAssignment::create($data);

        return back()->with('message', 'Assignment added.');
    }

    public function storeExam(Request $request, CourseModule $module)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'duration_minutes' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        ModuleExam::create([
            'course_module_id' => $module->id,
            'title' => $request->title,
            'duration_minutes' => $request->duration_minutes,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return back()->with('message', 'Exam created as draft. Add questions, then publish.');
    }

    public function storeQuestion(Request $request, ModuleExam $exam)
    {
        $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_option' => 'required|in:a,b,c,d',
        ]);

        ExamQuestion::create([
            'module_exam_id' => $exam->id,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_option' => $request->correct_option,
        ]);

        return back()->with('message', 'Question added.');
    }

    public function publishExam(ModuleExam $exam)
    {
        if ($exam->questions()->count() === 0) {
            return back()->with('message', 'Add at least one question before publishing.');
        }

        $exam->update(['status' => 'published']);

        return back()->with('message', 'Exam published! Students can now see it.');
    }

    public function examResults(ModuleExam $exam)
    {
        $instructor = Auth::user()->instructor;

        if (!$instructor || $exam->module->instructor_id !== $instructor->id) {
            abort(403);
        }

        $attempts = $exam->attempts()->with('student', 'answers.question')->get();

        return view('teacher_exam_results', compact('exam', 'attempts'));
    }

    public function destroyTopic(ModuleTopic $topic)
    {
        if ($topic->file_path) {
            Storage::disk('public')->delete($topic->file_path);
        }
        $topic->delete();

        return back()->with('message', 'Topic deleted.');
    }

    public function destroyAssignment(ModuleAssignment $assignment)
    {
        if ($assignment->file_path) {
            Storage::disk('public')->delete($assignment->file_path);
        }
        $assignment->delete();

        return back()->with('message', 'Assignment deleted.');
    }

    public function destroyExam(ModuleExam $exam)
    {
        $exam->delete();

        return back()->with('message', 'Exam deleted.');
    }

    public function destroyQuestion(ExamQuestion $question)
    {
        $question->delete();

        return back()->with('message', 'Question deleted.');
    }

    public function assignmentsIndex()
    {
        $instructor = Auth::user()->instructor;

        $assignments = ModuleAssignment::whereHas('module', function ($q) use ($instructor) {
            $q->where('instructor_id', $instructor->id);
        })
            ->with('module')
            ->withCount([
                'submissions',
                'submissions as pending_review_count' => function ($q) {
                    $q->where('checked', false);
                },
            ])
            ->get();

        return view('teacher_assignments_index', compact('assignments'));
    }

    public function assignmentSubmissions(ModuleAssignment $assignment)
    {
        $instructor = Auth::user()->instructor;

        if (!$instructor || $assignment->module->instructor_id !== $instructor->id) {
            abort(403);
        }

        $submissions = $assignment->submissions()->with('student')->orderByDesc('submitted_at')->get();

        return view('teacher_assignment_submissions', compact('assignment', 'submissions'));
    }

    public function gradeSubmission(Request $request, AssignmentSubmission $submission)
    {
        $instructor = Auth::user()->instructor;

        if (!$instructor || $submission->assignment->module->instructor_id !== $instructor->id) {
            abort(403);
        }

        $request->validate([
            'marks'    => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string|max:2000',
        ]);

        $submission->update([
            'marks'      => $request->marks,
            'feedback'   => $request->feedback,
            'checked'    => true,
            'checked_at' => now(),
        ]);

        return back()->with('message', 'Submission checked and marks saved.');
    }

    public function publishSubmission(AssignmentSubmission $submission)
    {
        $instructor = Auth::user()->instructor;

        if (!$instructor || $submission->assignment->module->instructor_id !== $instructor->id) {
            abort(403);
        }

        if (!$submission->checked) {
            return back()->with('message', 'Check the submission and enter marks before publishing.');
        }

        $submission->update([
            'published'    => true,
            'published_at' => now(),
        ]);

        return back()->with('message', 'Marks published. The student can now see their result.');
    }

    public function publishAllSubmissions(ModuleAssignment $assignment)
    {
        $instructor = Auth::user()->instructor;

        if (!$instructor || $assignment->module->instructor_id !== $instructor->id) {
            abort(403);
        }

        $assignment->submissions()->where('checked', true)->where('published', false)->update([
            'published'    => true,
            'published_at' => now(),
        ]);

        return back()->with('message', 'All checked submissions have been published.');
    }

}

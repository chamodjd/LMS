<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Student;
use App\Models\ModuleAssignment;
use App\Models\ModuleExam;
use App\Models\ExamQuestion;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function studentDashboard()
    {
        $student = Auth::user()->student;
        $course = Course::where('name', $student->degree)->first();

        $modules = collect();
        $totalModules = 0;
        $completedExams = 0;
        $avgScore = 0;

        if ($course) {
            $modules = $course->modules()->with('exams.attempts', 'assignments.submissions')->get();
            $totalModules = $modules->count();

            $allAttempts = $modules->flatMap(function ($module) use ($student) {
                return $module->exams->flatMap(function ($exam) use ($student) {
                    return $exam->attempts->where('student_id', $student->id)->whereNotNull('submitted_at');
                });
            });

            $completedExams = $allAttempts->count();

            if ($completedExams > 0) {
                $avgScore = round($allAttempts->avg(function ($attempt) {
                    return $attempt->total_questions > 0 ? ($attempt->score / $attempt->total_questions) * 100 : 0;
                }));
            }
        }

        return view('student_dashboard', compact('student', 'course', 'modules', 'totalModules', 'completedExams', 'avgScore'));
    }

    public function myCourse()
    {
        $student = Auth::user()->student;
        $course = Course::where('name', $student->degree)->firstOrFail();
        $modules = $course->modules()->with('instructor')->get();

        return view('student_course', compact('course', 'modules'));
    }

    public function moduleDetail(CourseModule $module)
    {
        $student = Auth::user()->student;

        if ($module->course->name !== $student->degree) {
            abort(403, 'You are not enrolled in this course.');
        }

        $module->load(['topics', 'assignments.submissions', 'exams' => function ($q) {
            $q->where('status', 'published');
        }]);

        $module->assignments->each(function ($assignment) use ($student) {
            $assignment->my_submission = $assignment->submissions->where('student_id', $student->id)->first();
        });

        $module->exams->each(function ($exam) use ($student) {
            $exam->my_attempt = $exam->attempts()->where('student_id', $student->id)->whereNotNull('submitted_at')->first();
        });

        return view('student_module_detail', compact('module'));
    }

    public function submitAssignment(Request $request, ModuleAssignment $assignment)
    {
        $request->validate([
            'file' => 'required|file|max:20480',
        ]);

        $student = Auth::user()->student;

        if ($assignment->module->course->name !== $student->degree) {
            abort(403);
        }

        $existing = AssignmentSubmission::where('module_assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->first();

        $file = $request->file('file');
        $path = $file->store('submissions', 'public');

        if ($existing) {
            Storage::disk('public')->delete($existing->file_path);
            $existing->update([
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'submitted_at' => now(),
            ]);
        } else {
            AssignmentSubmission::create([
                'module_assignment_id' => $assignment->id,
                'student_id' => $student->id,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'submitted_at' => now(),
            ]);
        }

        return back()->with('message', 'Assignment submitted successfully.');
    }

    public function takeExam(ModuleExam $exam)
    {
        if ($exam->status !== 'published') {
            abort(404);
        }

        $student = Auth::user()->student;

        $existingAttempt = ExamAttempt::where('module_exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->whereNotNull('submitted_at')
            ->first();

        if ($existingAttempt) {
            return redirect()->route('student.dashboard')->with('message', 'You have already submitted this exam.');
        }

        $questions = $exam->questions()->select('id', 'module_exam_id', 'question', 'option_a', 'option_b', 'option_c', 'option_d')->get();

        return view('student_take_exam', compact('exam', 'questions'));
    }

    public function submitExam(Request $request, ModuleExam $exam)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:a,b,c,d',
        ]);

        $student = Auth::user()->student;

        $alreadySubmitted = ExamAttempt::where('module_exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->whereNotNull('submitted_at')
            ->exists();

        if ($alreadySubmitted) {
            return redirect()->route('student.dashboard')->with('message', 'You have already submitted this exam.');
        }

        $attempt = ExamAttempt::create([
            'module_exam_id' => $exam->id,
            'student_id' => $student->id,
            'submitted_at' => now(),
        ]);

        $score = 0;
        $total = count($request->answers);

        foreach ($request->answers as $questionId => $selectedOption) {
            $question = ExamQuestion::find($questionId);
            $isCorrect = $question->correct_option === $selectedOption;

            if ($isCorrect) {
                $score++;
            }

            ExamAnswer::create([
                'exam_attempt_id' => $attempt->id,
                'exam_question_id' => $questionId,
                'selected_option' => $selectedOption,
                'is_correct' => $isCorrect,
            ]);
        }

        $attempt->update(['score' => $score, 'total_questions' => $total]);

        return redirect()->route('student.dashboard')->with('message', "Exam submitted! You scored {$score}/{$total}.");
    }

    public function myResults()
    {
        $student = Auth::user()->student;
        $course = Course::where('name', $student->degree)->first();

        $modules = collect();

        if ($course) {
            $modules = $course->modules()->with([
                'exams' => function ($q) {
                    $q->where('status', 'published');
                },
                'exams.attempts' => function ($q) use ($student) {
                    $q->where('student_id', $student->id)->whereNotNull('submitted_at');
                },
                'assignments.submissions' => function ($q) use ($student) {
                    $q->where('student_id', $student->id);
                },
            ])->get();
        }

        return view('student_results', compact('student', 'course', 'modules'));
    }

}

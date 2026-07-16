<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('/about', [\App\Http\Controllers\AdminController::class, 'about'])->name('admin.about');
Route::get('/course', [\App\Http\Controllers\AdminController::class, 'course'])->name('admin.course');
Route::get('/course_details', [\App\Http\Controllers\AdminController::class, 'course_details'])->name('admin.course_details');
Route::get('/instructor', [\App\Http\Controllers\AdminController::class, 'instructor'])->name('admin.instructor');
Route::get('/ins_details', [\App\Http\Controllers\AdminController::class, 'ins_details'])->name('admin.ins_details');
Route::get('/pricing', [\App\Http\Controllers\AdminController::class, 'pricing'])->name('admin.pricing');
Route::get('/admin/contact', [AdminController::class, 'contactMessages'])->name('admin.contact');
Route::post('/contact/send', [AdminController::class, 'contactSend'])->name('contact.send');
Route::post('/contact/send', [\App\Http\Controllers\AdminController::class, 'contactSend'])->name('contact.send');
Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/student-dashboard', [\App\Http\Controllers\StudentController::class, 'studentDashboard'])->name('student.dashboard');
Route::get('/teacher-dashboard', [\App\Http\Controllers\TeacherController::class, 'teacherDashboard'])->name('teacher.dashboard');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/admin/courses', [AdminController::class, 'coursesPage'])->name('admin.courses');
Route::post('/admin/courses', [AdminController::class, 'storeCourse'])->name('admin.courses.store');
Route::put('/admin/students/{student}', [AdminController::class, 'updateStudent'])->name('admin.students.update');
Route::delete('/admin/students/{student}', [AdminController::class, 'destroyStudent'])->name('admin.students.destroy');
Route::put('/admin/courses/{course}', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
Route::delete('/admin/courses/{course}', [AdminController::class, 'destroyCourse'])->name('admin.courses.destroy');
Route::put('/admin/instructors/{instructor}', [AdminController::class, 'updateInstructor'])->name('admin.instructors.update');
Route::delete('/admin/instructors/{instructor}', [AdminController::class, 'destroyInstructor'])->name('admin.instructors.destroy');
Route::post('/admin/students/import', [AdminController::class, 'importStudents'])->name('admin.students.import');
Route::get('/admin/students/export/pdf', [AdminController::class, 'exportStudentsPdf'])->name('admin.students.export.pdf');
Route::post('/admin/instructors/import', [AdminController::class, 'importInstructors'])->name('admin.instructors.import');
Route::get('/admin/instructors/export-pdf', [AdminController::class, 'exportInstructorsPdf'])->name('admin.instructors.export.pdf');
Route::get('/admin/courses/export-pdf', [AdminController::class, 'exportCoursesPdf'])->name('admin.courses.export.pdf');
Route::get('/admin/courses/{course}/modules', [AdminController::class, 'courseModules'])->name('admin.courses.modules');
Route::post('/admin/courses/{course}/modules', [AdminController::class, 'storeModule'])->name('admin.modules.store');
Route::put('/admin/modules/{module}', [AdminController::class, 'updateModule'])->name('admin.modules.update');
Route::delete('/admin/modules/{module}', [AdminController::class, 'destroyModule'])->name('admin.modules.destroy');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/students', [AdminController::class, 'studentsPage'])->name('admin.students');
    Route::get('/admin/instructors', [AdminController::class, 'instructorsPage'])->name('admin.instructors');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'teacherDashboard'])->name('teacher.dashboard');
    Route::get('/teacher/modules', [TeacherController::class, 'myModules'])->name('teacher.modules');
    Route::get('/teacher/exams/{exam}/results', [TeacherController::class, 'examResults'])->name('teacher.exams.results');

    Route::get('/teacher/assignments', [TeacherController::class, 'assignmentsIndex'])->name('teacher.assignments.index');
    Route::get('/teacher/assignments/{assignment}/submissions', [TeacherController::class, 'assignmentSubmissions'])->name('teacher.assignments.submissions');
    Route::post('/teacher/submissions/{submission}/grade', [TeacherController::class, 'gradeSubmission'])->name('teacher.submissions.grade');
    Route::post('/teacher/submissions/{submission}/publish', [TeacherController::class, 'publishSubmission'])->name('teacher.submissions.publish');
    Route::post('/teacher/assignments/{assignment}/publish-all', [TeacherController::class, 'publishAllSubmissions'])->name('teacher.assignments.publish-all');

    Route::delete('/teacher/topics/{topic}', [TeacherController::class, 'destroyTopic'])->name('teacher.topics.destroy');
    Route::delete('/teacher/assignments/{assignment}', [TeacherController::class, 'destroyAssignment'])->name('teacher.assignments.destroy');
    Route::delete('/teacher/exams/{exam}', [TeacherController::class, 'destroyExam'])->name('teacher.exams.destroy');
    Route::post('/teacher/exams/{exam}/publish', [TeacherController::class, 'publishExam'])->name('teacher.exams.publish');
    Route::post('/teacher/exams/{exam}/questions', [TeacherController::class, 'storeQuestion'])->name('teacher.questions.store');
    Route::delete('/teacher/questions/{question}', [TeacherController::class, 'destroyQuestion'])->name('teacher.questions.destroy');
});

Route::middleware(['auth', 'role:teacher', 'teacher.module'])->group(function () {
    Route::get('/teacher/modules/{module}', [TeacherController::class, 'moduleDetail'])->name('teacher.modules.show');
    Route::post('/teacher/modules/{module}/topics', [TeacherController::class, 'storeTopic'])->name('teacher.topics.store');
    Route::post('/teacher/modules/{module}/assignments', [TeacherController::class, 'storeAssignment'])->name('teacher.assignments.store');
    Route::post('/teacher/modules/{module}/exams', [TeacherController::class, 'storeExam'])->name('teacher.exams.store');
});

Route::get('/admin/modules/{module}', [AdminController::class, 'moduleDetail'])->name('admin.modules.show');

// Topics
Route::post('/admin/modules/{module}/topics', [AdminController::class, 'storeTopic'])->name('admin.topics.store');
Route::delete('/admin/topics/{topic}', [AdminController::class, 'destroyTopic'])->name('admin.topics.destroy');

// Assignments
Route::post('/admin/modules/{module}/assignments', [AdminController::class, 'storeAssignment'])->name('admin.assignments.store');
Route::delete('/admin/assignments/{assignment}', [AdminController::class, 'destroyAssignment'])->name('admin.assignments.destroy');

// Exams
Route::post('/admin/modules/{module}/exams', [AdminController::class, 'storeExam'])->name('admin.exams.store');
Route::delete('/admin/exams/{exam}', [AdminController::class, 'destroyExam'])->name('admin.exams.destroy');
Route::post('/admin/exams/{exam}/questions', [AdminController::class, 'storeQuestion'])->name('admin.questions.store');
Route::delete('/admin/questions/{question}', [AdminController::class, 'destroyQuestion'])->name('admin.questions.destroy');
Route::post('/admin/exams/{exam}/publish', [AdminController::class, 'publishExam'])->name('admin.exams.publish');

Route::middleware(['auth'])->group(function () {
    Route::get('/student/my-course', [StudentController::class, 'myCourse'])->name('student.course');
    Route::get('/student/modules/{module}', [StudentController::class, 'moduleDetail'])->name('student.modules.show');
    Route::get('/student/results', [StudentController::class, 'myResults'])->name('student.results');

    Route::post('/student/assignments/{assignment}/submit', [StudentController::class, 'submitAssignment'])->name('student.assignments.submit');

    Route::get('/student/exams/{exam}/take', [StudentController::class, 'takeExam'])->name('student.exams.take');
    Route::post('/student/exams/{exam}/submit', [StudentController::class, 'submitExam'])->name('student.exams.submit');
});

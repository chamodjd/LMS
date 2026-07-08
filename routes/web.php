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
Route::get('/contact', [\App\Http\Controllers\AdminController::class, 'contact'])->name('admin.contact');
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

Route::middleware(['auth', 'role:teacher'])
    ->get('/teacher/dashboard', [TeacherController::class, 'teacherDashboard']) // or whatever it's actually called
    ->name('teacher.dashboard');
Route::middleware(['auth', 'role:student'])
    ->get('/student/dashboard', [StudentController::class, 'studentDashboard'])
    ->name('student.dashboard');

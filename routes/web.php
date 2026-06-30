<?php

use Illuminate\Support\Facades\Route;

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

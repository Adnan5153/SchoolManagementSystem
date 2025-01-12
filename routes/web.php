<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\AddStudentController;
use App\Http\Controllers\Admin\Auth\AllStudentController;
use App\Http\Controllers\Admin\Auth\AddTeacherController;
use App\Http\Controllers\Admin\Auth\AllTeacherController;
use App\Http\Controllers\Teacher\Auth\MarkController;
use App\Http\Controllers\Student\GpaController; // Import GpaController
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Student Routes
    Route::get('/addstudent', [AddStudentController::class, 'create'])->name('register.student.and.parent');
    Route::post('/addstudent', [AddStudentController::class, 'store'])->name('register.student.and.parent.store');

    Route::get('/allstudent', [AllStudentController::class, 'index'])->name('allstudent.index');
    Route::put('/allstudent/{student_id}', [AllStudentController::class, 'update'])->name('allstudent.update');
    Route::delete('/allstudent/{student_id}', [AllStudentController::class, 'destroy'])->name('allstudent.destroy');

    // Teacher Routes
    Route::get('/addteacher', [AddTeacherController::class, 'create'])->name('addteacher.create');
    Route::post('/addteacher', [AddTeacherController::class, 'store'])->name('addteacher.store');

    Route::get('/allteachers', [AllTeacherController::class, 'index'])->name('allteachers.index');
    Route::put('/allteachers/{teacher_id_number}', [AllTeacherController::class, 'update'])->name('allteachers.update');
    Route::delete('/allteachers/{teacher_id_number}', [AllTeacherController::class, 'destroy'])->name('allteachers.destroy');
});

// Teacher Routes
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::get('/addmarks', [MarkController::class, 'create'])->name('teacher.addmarks');
    Route::post('/addmarks', [MarkController::class, 'store'])->name('teacher.storemarks');
});

// Teacher Routes
Route::prefix('student')->middleware('auth:student')->group(function () {
    // GPA Management Routes
    Route::get('/gpa', [GpaController::class, 'index'])->name('gpa'); // View GPA page
    Route::post('/gpa', [GpaController::class, 'store'])->name('gpa.store'); // Store GPA entry
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/teacher-auth.php';
require __DIR__.'/student-auth.php';

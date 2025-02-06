<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\AddStudentController;
use App\Http\Controllers\Admin\Auth\AllStudentController;
use App\Http\Controllers\Admin\Auth\AddTeacherController;
use App\Http\Controllers\Admin\Auth\AllTeacherController;
use App\Http\Controllers\Admin\Auth\ClassController;
use App\Http\Controllers\Admin\Auth\ClassRoutineController;
use App\Http\Controllers\Teacher\Auth\MarkController;
use App\Http\Controllers\Admin\Auth\AddSubjectController;
use App\Http\Controllers\Student\GpaController; // Import GpaController
use App\Http\Controllers\Student\Auth\StudentClassRoutineController;
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

    // Subject Routes
    Route::get('/subjects', [AddSubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/create', [AddSubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [AddSubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}/edit', [AddSubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [AddSubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [AddSubjectController::class, 'destroy'])->name('subjects.destroy');

    // Class Routes
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/add', [ClassController::class, 'create'])->name('classes.create');
    Route::post('/classes/store', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/edit/{id}', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/update/{id}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/delete/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');

    // Class Routine Routes
    Route::get('/classroutines', [ClassRoutineController::class, 'index'])->name('classroutines.index');
    Route::get('/classroutines/add', [ClassRoutineController::class, 'create'])->name('classroutines.create');
    Route::post('/classroutines/store', [ClassRoutineController::class, 'store'])->name('classroutines.store');
    Route::get('/classroutines/edit/{id}', [ClassRoutineController::class, 'edit'])->name('classroutines.edit');
    Route::put('/classroutines/update/{id}', [ClassRoutineController::class, 'update'])->name('classroutines.update');
    Route::delete('/classroutines/delete/{id}', [ClassRoutineController::class, 'destroy'])->name('classroutines.destroy');
});

// Teacher Routes
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::get('/addmarks', [MarkController::class, 'create'])->name('teacher.addmarks');
    Route::post('/addmarks', [MarkController::class, 'store'])->name('teacher.storemarks');
});

// Student Routes
Route::prefix('student')->middleware('auth:student')->group(function () {
    // GPA Management Routes
    Route::get('/gpa', [GpaController::class, 'index'])->name('gpa'); // View GPA page
    Route::post('/gpa', [GpaController::class, 'store'])->name('gpa.store'); // Store GPA entry

    // Student Class Routine Routes
    Route::get('/classroutine', [StudentClassRoutineController::class, 'index'])
        ->name('student.classroutine');
    
    
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/teacher-auth.php';
require __DIR__.'/student-auth.php';

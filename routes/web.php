<?php

use App\Http\Controllers\Admin\Auth\AddExamScheduleController;
use App\Http\Controllers\Admin\Auth\AddStudentController;
use App\Http\Controllers\Admin\Auth\AddSubjectController;
use App\Http\Controllers\Admin\Auth\AddTeacherController;
use App\Http\Controllers\Admin\Auth\AllStudentController;
use App\Http\Controllers\Admin\Auth\AllTeacherController;
use App\Http\Controllers\Admin\Auth\ClassController;
use App\Http\Controllers\Admin\Auth\ClassRoutineController;
use App\Http\Controllers\Admin\Auth\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\Auth\FullCalenderController;
use App\Http\Controllers\Student\Auth\StudentClassRoutineController;
use App\Http\Controllers\Student\Auth\StudentDashboardController;
use App\Http\Controllers\Student\Auth\StudentExamController;
use App\Http\Controllers\Student\Auth\StudentLibraryController;
use App\Http\Controllers\Student\Auth\StudentMarksController;
use App\Http\Controllers\Student\Auth\StudentNoticeController;
use App\Http\Controllers\Student\Auth\StudentProfileController;
use App\Http\Controllers\Student\Auth\StudentSubjectController;
use App\Http\Controllers\Student\GpaController; // Import GpaController
use App\Http\Controllers\Teacher\Auth\AnnouncementController;
use App\Http\Controllers\Teacher\Auth\AssignmentController;
use App\Http\Controllers\Teacher\Auth\AttendanceController;
use App\Http\Controllers\Teacher\Auth\ClassListController;
use App\Http\Controllers\Teacher\Auth\ExamController;
use App\Http\Controllers\Teacher\Auth\GradebookController;
use App\Http\Controllers\Teacher\Auth\MarkController;
use App\Http\Controllers\Teacher\Auth\MessageController;
use App\Http\Controllers\Teacher\Auth\NoticeController;
use App\Http\Controllers\Teacher\Auth\ProgressController;
use App\Http\Controllers\Teacher\Auth\RemarksController;
use App\Http\Controllers\Teacher\Auth\ResourceController;
use App\Http\Controllers\Teacher\Auth\RoutineController;
use App\Http\Controllers\Teacher\Auth\StudentListController;
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

    // Parent Routes
    Route::get('/allparents', [AllStudentController::class, 'showParents'])->name('allparents.index');
    Route::put('/allparents/{parent_id}', [AllStudentController::class, 'updateParent'])->name('allparents.update');
    Route::delete('/allparents/{parent_id}', [AllStudentController::class, 'destroyParent'])->name('allparents.destroy');

    // Teacher Routes
    Route::get('/addteacher', [AddTeacherController::class, 'create'])->name('addteacher.create');
    Route::post('/addteacher', [AddTeacherController::class, 'store'])->name('addteacher.store');
    Route::get('/allteachers', [AllTeacherController::class, 'index'])->name('allteachers.index');
    Route::put('/allteachers/{id}', [AllTeacherController::class, 'update'])->name('allteachers.update');
    Route::delete('/allteachers/{id}', [AllTeacherController::class, 'destroy'])->name('allteachers.destroy');

    // Subject Routes
    Route::get('/subjects', [AddSubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/create', [AddSubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [AddSubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}/edit', [AddSubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/subjects/{subject}', [AddSubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}', [AddSubjectController::class, 'destroy'])->name('subjects.destroy');
    Route::get('/subjects/filter', [AddSubjectController::class, 'filterSubjects'])->name('subjects.filter');

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
    Route::get('/classroutines/get-subjects', [ClassRoutineController::class, 'getSubjectsByClass'])->name('classroutines.get-subjects');

    // Admin Routes for Grade Management
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/grades/{grade}/edit', [GradeController::class, 'edit'])->name('grades.edit');
    Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('grades.update');
    Route::delete('/grades/{grade}', [GradeController::class, 'destroy'])->name('grades.destroy');

    // Exam Schedule Routes
    Route::get('/addexamschedule', [AddExamScheduleController::class, 'index'])->name('examschedule.index');
    Route::post('/addexamschedule', [AddExamScheduleController::class, 'store'])->name('examschedule.store');
    Route::get('/examschedule', [AddExamScheduleController::class, 'show'])->name('examschedule.list');
    Route::get('/examschedule/{id}/edit', [AddExamScheduleController::class, 'edit'])->name('examschedule.edit');
    Route::put('/examschedule/{id}', [AddExamScheduleController::class, 'update'])->name('examschedule.update');
    Route::delete('/examschedule/{id}', [AddExamScheduleController::class, 'destroy'])->name('examschedule.destroy');
    Route::get('/examschedule/get-subjects', [AddExamScheduleController::class, 'getSubjectsByClass'])->name('examschedule.get-subjects');

});

// Teacher Routes
Route::prefix('teacher')->middleware('auth:teacher')->group(function () {
    Route::get('/addmarks', [MarkController::class, 'create'])->name('teacher.addmarks');
    Route::post('/addmarks', [MarkController::class, 'store'])->name('teacher.storemarks');
    Route::post('/fetch-students', [MarkController::class, 'fetchStudents'])->name('teacher.fetchstudents');
    Route::post('/fetch-subjects', [MarkController::class, 'fetchSubjects'])->name('teacher.fetchsubjects');
    Route::get('/classes', [ClassListController::class, 'index'])->name('teacher.classes');
    Route::get('/students', [StudentListController::class, 'index'])->name('teacher.students');

    Route::get('/attendance/take', [AttendanceController::class, 'take'])->name('teacher.attendance.take');
    Route::get('/attendance/report', [AttendanceController::class, 'report'])->name('teacher.attendance.report');

    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('teacher.assignments.create');
    Route::get('/assignments/manage', [AssignmentController::class, 'manage'])->name('teacher.assignments.manage');
    Route::get('/assignments/submissions', [AssignmentController::class, 'submissions'])->name('teacher.assignments.submissions');

    Route::get('/exam/schedule', [ExamController::class, 'schedule'])->name('teacher.exam.schedule');
    Route::get('/exam/gradebook', [GradebookController::class, 'index'])->name('teacher.gradebook');

    Route::get('/routine', [RoutineController::class, 'index'])->name('teacher.routine');

    Route::get('/progress', [ProgressController::class, 'index'])->name('teacher.progress');
    Route::put('/progress/{id}', [ProgressController::class, 'update'])->name('progress.update');
    Route::delete('/progress/{id}', [ProgressController::class, 'destroy'])->name('progress.destroy');

    Route::get('/remarks', [RemarksController::class, 'index'])->name('teacher.remarks');

    Route::get('/messages', [MessageController::class, 'index'])->name('teacher.messages');
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('teacher.announcements');

    Route::get('/notice', [NoticeController::class, 'index'])->name('teacher.notice');

    Route::get('/resources/upload', [ResourceController::class, 'upload'])->name('teacher.resources.upload');
    Route::get('/resources/shared', [ResourceController::class, 'shared'])->name('teacher.resources.shared');
});

// Student Routes
Route::prefix('student')->middleware('auth:student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('student.profile');

    Route::get('/marks', [StudentMarksController::class, 'index'])->name('student.marks');
    Route::get('/subjects', [StudentSubjectController::class, 'index'])->name('student.subjects');
    Route::get('/library', [StudentLibraryController::class, 'index'])->name('student.library');
    Route::get('/notice', [StudentNoticeController::class, 'index'])->name('student.notice');
    Route::get('/exam-schedule', [StudentExamController::class, 'index'])->name('student.exam.schedule');
    // GPA Management Routes
    Route::get('/gpa', [GpaController::class, 'index'])->name('gpa'); // View GPA page
    Route::post('/gpa', [GpaController::class, 'store'])->name('gpa.store'); // Store GPA entry

    // Student Class Routine Routes
    Route::get('/classroutine', [StudentClassRoutineController::class, 'index'])
        ->name('student.classroutine');
    Route::get('/fullcalender', [FullCalenderController::class, 'index']);

    Route::post('/fullcalenderAjax', [FullCalenderController::class, 'ajax']);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
require __DIR__ . '/teacher-auth.php';
require __DIR__ . '/student-auth.php';

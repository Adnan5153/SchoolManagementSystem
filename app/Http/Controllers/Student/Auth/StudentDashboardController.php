<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\ClassRoutine;
use App\Models\ExamSchedule;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Total Subjects
        $subjectsCount = Subject::where('class_id', $student->class_id)->count();

        // Total Marks
        $marksCount = Mark::where('student_id', $student->id)->count();

        // Total Teachers (by subject assignments)
        $teachersCount = Teacher::where('class_id', $student->class_id)
            ->distinct('id')->count('id');

        // Today's Classes
        $today = Carbon::now()->format('l'); // Full weekday name
        $todayClasses = ClassRoutine::with(['subject', 'teacher'])
            ->where('class_id', $student->class_id)
            ->where('day_of_week', $today)
            ->get();

        // Exam Schedules
        $examSchedules = ExamSchedule::with('subject')
            ->where('class_id', $student->class_id)
            ->orderBy('exam_date', 'asc')
            ->get();

        return view('student.dashboard', compact(
            'subjectsCount',
            'marksCount',
            'teachersCount',
            'todayClasses',
            'examSchedules'
        ));
    }
}

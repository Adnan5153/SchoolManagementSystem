<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoutine;
use Illuminate\Support\Facades\Auth;

class StudentClassRoutineController extends Controller
{
    /**
     * Display the student's class routine.
     */
    public function index()
    {
        $student = Auth::user();

        if (!$student) {
            return "User not authenticated";
        }

        if (!$student->class_id) {
            return "Student does not have a class assigned.";
        }

        // Fetch class routine for the student's class
        $class_routines = ClassRoutine::where('class_id', $student->class_id)
            ->with(['subject', 'teacher'])
            ->orderByRaw("FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->orderBy('start_time')
            ->get();

        if ($class_routines->isEmpty()) {
            return "No class routine found for class ID: " . $student->class_id;
        }

        return view('student.layouts.classroutine', compact('class_routines'));
    }
}

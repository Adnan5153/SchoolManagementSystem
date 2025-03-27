<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class StudentMarksController extends Controller
{
    public function index()
    {
        $studentEmail = Auth::guard('student')->user()->email;

        // Get marks where the student's email matches with student email
        $marks = Mark::with(['teacher', 'allstudent'])
            ->whereHas('allstudent', function ($query) use ($studentEmail) {
                $query->where('email', $studentEmail);
            })
            ->get();

        $grades = Grade::all();

        return view('student.layouts.marks', compact('marks', 'grades'));
    }
}

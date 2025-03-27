<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamSchedule;

class StudentExamController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();

        $examSchedules = ExamSchedule::with(['class', 'subject'])
            ->where('class_id', $student->class_id)
            ->whereHas('class', function ($query) use ($student) {
                $query->where('section', $student->section);
            })
            ->get();

        return view('student.layouts.exam', compact('examSchedules'));
    }
}

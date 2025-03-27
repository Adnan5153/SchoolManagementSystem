<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Models\ExamSchedule;

class ExamController extends Controller
{
    public function schedule()
    {
        $examSchedules = ExamSchedule::with(['class', 'subject'])->get();
        return view('teacher.layouts.exam_schedule', compact('examSchedules'));
    }
}

<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function take()
    {
        return view('teacher.layouts.attendance_take');
    }

    public function report()
    {
        return view('teacher.layouts.attendance_report');
    }
}

<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function create()
    {
        return view('teacher.layouts.assignments_create');
    }
    public function manage()
    {
        return view('teacher.layouts.assignments_manage');
    }
    public function submissions()
    {
        return view('teacher.layouts.assignments_submissions');
    }
}
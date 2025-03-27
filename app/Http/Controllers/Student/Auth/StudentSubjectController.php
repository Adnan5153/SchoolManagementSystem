<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class StudentSubjectController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        $subjects = Subject::where('class_id', $student->class_id)->get();

        return view('student.layouts.subjects', compact('subjects'));
    }
}

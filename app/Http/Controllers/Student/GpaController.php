<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GpaController extends Controller
{
    /**
     * Display the GPA page for the authenticated student.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('student.layouts.gpa', compact('grades'));
    }

    /**
     * Store a new GPA record for the authenticated student.
     */
    public function store(Request $request)
    {
       //
    }
}

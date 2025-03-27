<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Models\Grade;

class GradebookController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return view('teacher.layouts.gradebook', compact('grades'));
    }
}

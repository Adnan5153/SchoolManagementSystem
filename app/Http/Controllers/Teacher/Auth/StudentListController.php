<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Models\AllStudent;

class StudentListController extends Controller
{
    public function index()
    {
        $students = AllStudent::with('class')->paginate(10); // 10 per page
        return view('teacher.layouts.students', compact('students'));
    }
}

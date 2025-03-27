<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentNoticeController extends Controller
{
    public function index()
    {
        return view('student.layouts.notice');
    }
}
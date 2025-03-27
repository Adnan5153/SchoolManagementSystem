<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;

class RemarksController extends Controller
{
    public function index()
    {
        return view('teacher.layouts.remarks');
    }
}

<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function index()
    {
        return view('teacher.layouts.notice');
    }
}

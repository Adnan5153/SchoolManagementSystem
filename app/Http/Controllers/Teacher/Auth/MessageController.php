<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        return view('teacher.layouts.messages');
    }
}

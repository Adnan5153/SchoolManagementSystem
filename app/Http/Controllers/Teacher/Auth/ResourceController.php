<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    public function upload()
    {
        return view('teacher.layouts.resources_upload');
    }
    public function shared()
    {
        return view('teacher.layouts.resources_shared');
    }
}

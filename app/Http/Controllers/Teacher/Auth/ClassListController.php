<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;

class ClassListController extends Controller
{
    public function index()
    {
        $groupedClasses = ClassModel::all()->groupBy('class_name');
        return view('teacher.layouts.classes', compact('groupedClasses'));
    }
}

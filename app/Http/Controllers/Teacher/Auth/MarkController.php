<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Mark;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
    public function create()
    {
        $classes = ClassModel::all();
        return view('teacher.layouts.addmarks', compact('classes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string|max:255',
            'marks' => 'required|integer|min:0|max:100',
            'remarks' => 'nullable|string',
        ]);

        Mark::create([
            'teacher_id' => Auth::id(),
            'student_id' => $validatedData['student_id'],
            'subject' => $validatedData['subject'],
            'marks' => $validatedData['marks'],
            'remarks' => $validatedData['remarks'],
        ]);

        return redirect()->route('teacher.addmarks')->with('success', 'Marks have been successfully added.');
    }

    public function fetchStudents(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer|exists:classes,id',
            'section' => 'required|string|max:10'
        ]);

        $students = \App\Models\Student::where('class_id', $request->class_id)
            ->where('section', $request->section)
            ->get(['id', 'name']);

        return response()->json($students);
    }

    public function fetchSubjects(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer|exists:classes,id',
        ]);

        $subjects = Subject::where('class_id', $request->class_id)->get(['id', 'name']);

        return response()->json($subjects);
    }
}

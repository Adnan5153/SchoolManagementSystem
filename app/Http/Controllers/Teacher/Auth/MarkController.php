<?php

namespace App\Http\Controllers\Teacher\Auth;    
use App\Models\AllStudent;
use App\Models\Mark;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkController extends Controller
{
      /**
     * Show the form for adding marks.
     */
    public function create()
    {
        $students = AllStudent::all();  // Retrieve all students
        return view('teacher.layouts.addmarks', ['students' => $students]);
    }

    /**
     * Store the marks submitted by the teacher.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:allstudents,student_id',
            'subject' => 'required|string|max:255',
            'marks' => 'required|integer|min:0|max:100',
            'remarks' => 'nullable|string',
        ]);

        // Store the mark assigned by the logged-in teacher
        Mark::create([
            'teacher_id_number' => Auth::id(),
            'student_id' => $validatedData['student_id'],
            'subject' => $validatedData['subject'],
            'marks' => $validatedData['marks'],
            'remarks' => $validatedData['remarks'],
        ]);

        return redirect()->route('teacher.addmarks')->with('success', 'Marks have been successfully added.');
    }
}

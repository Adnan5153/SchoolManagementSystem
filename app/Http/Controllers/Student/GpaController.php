<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gpa;
use App\Models\AllStudent;
use Illuminate\Support\Facades\Auth;

class GpaController extends Controller
{
    /**
     * Display the GPA page for the authenticated student.
     */
    public function index()
    {
        // Get the authenticated student's ID using the 'student' guard
        $studentId = Auth::guard('student')->id();

        // Fetch the student's details and GPA records
        $student = AllStudent::where('student_id', $studentId)->firstOrFail();
        $gpas = Gpa::where('student_id', $studentId)->get();

        // Return the view located at 'student/layouts/gpa.blade.php'
        return view('student.layouts.gpa', compact('student', 'gpas'));
    }

    /**
     * Store a new GPA record for the authenticated student.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'gpa' => 'required|numeric|between:0,4.00',
            'semester' => 'required|string|max:255',
        ]);

        // Create a new GPA record for the authenticated student
        Gpa::create([
            'student_id' => Auth::guard('student')->id(),
            'gpa' => $validated['gpa'],
            'semester' => $validated['semester'],
        ]);

        // Redirect back to the GPA page with a success message
        return redirect()->route('student.gpa')->with('success', 'GPA added successfully.');
    }
}

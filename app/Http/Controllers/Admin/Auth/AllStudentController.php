<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AllStudent;
use App\Models\ParentModel;
use Illuminate\Http\Request;

class AllStudentController extends Controller
{
    /**
     * Display a listing of all students with their parent information.
     */
    public function index()
    {
        // Eager load parent information
        $students = AllStudent::with('parent')->paginate(10);
        return view('admin.layouts.allstudent', compact('students'));
    }

    /**
     * Update the specified student in the database.
     */
    public function update(Request $request, $student_id)
    {
        // Fetch the student record
        $student = AllStudent::where('student_id', $student_id)->firstOrFail();
        $parent = $student->parent;

        // Validate student and parent data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'class' => 'required|string',
            'section' => 'required|string',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'religion' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:allstudents,email,' . $student_id . ',student_id',

            // Parent validation
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'present_address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        // Update student details
        $student->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'class' => $validatedData['class'],
            'section' => $validatedData['section'],
            'gender' => $validatedData['gender'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'religion' => $validatedData['religion'],
            'email' => $validatedData['email'],
        ]);

        // Update parent details if a parent record exists
        if ($parent) {
            $parent->update([
                'father_name' => $validatedData['father_name'],
                'mother_name' => $validatedData['mother_name'],
                'present_address' => $validatedData['present_address'],
                'phone_number' => $validatedData['phone_number'],
            ]);
        }

        return redirect()->route('allstudent.index')->with('success', 'Student and parent information updated successfully.');
    }

    /**
     * Delete a student and related parent data.
     */
    public function destroy($student_id)
    {
        // Find and delete student and related parent information
        $student = AllStudent::where('student_id', $student_id)->firstOrFail();
        $parent = $student->parent;

        if ($parent && $parent->students()->count() === 1) {
            // If this is the only student linked to the parent, delete the parent
            $parent->delete();
        }

        $student->delete();

        return redirect()->route('allstudent.index')->with('success', 'Student and related parent information deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AllTeacher;
use Illuminate\Http\Request;

class AllTeacherController extends Controller
{
    /**
     * Display a listing of all teachers.
     */
    public function index()
    {
        // Fetch all teachers with pagination
        $teachers = AllTeacher::paginate(10);

        // Pass the teacher data to the view
        return view('admin.layouts.allteachers', ['teachers' => $teachers]);
    }

    /**
     * Update a specific teacher's details in the database.
     *
     * @param  Request  $request
     * @param  string  $teacher_id_number
     */
    public function update(Request $request, $teacher_id_number)
    {
        // Validation rules
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'class' => 'required|string',
            'section' => 'required|string',
            'subject' => 'required|string',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'joining_date' => 'required|date',
            'nid_number' => 'nullable|integer',
            'religion' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:allteachers,email,' . $teacher_id_number . ',teacher_id_number',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Find the teacher using teacher_id_number
        $teacher = AllTeacher::findOrFail($teacher_id_number);

        // Update teacher data
        $teacher->update($validatedData);

        // Redirect to the list page with a success message
        return redirect()->route('allteachers.index')->with('success', 'Teacher updated successfully.');
    }


    /**
     * Remove a specific teacher from the database.
     *
     * @param  string  $teacher_id_number
     */
    public function destroy($teacher_id_number)
    {
        // Find and delete the teacher by their ID
        $teacher = AllTeacher::findOrFail($teacher_id_number);
        $teacher->delete();

        return redirect()->route('allteachers.index')->with('success', 'Teacher deleted successfully.');
    }
}

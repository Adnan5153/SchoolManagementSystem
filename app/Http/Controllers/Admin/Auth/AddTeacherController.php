<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AllTeacher;
use Illuminate\Http\Request;

class AddTeacherController extends Controller
{
    /**
     * Show the form for adding a new teacher.
     */
    public function create()
    {
        return view('admin.layouts.addteacher');
    }

    /**
     * Store a newly created teacher in the database.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'teacher_id_number' => 'required|integer|unique:allteachers,teacher_id_number',
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
            'email' => 'required|email|max:255|unique:allteachers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Create the teacher record
        AllTeacher::create($validatedData);

        return redirect()->route('addteacher.create')->with('success', 'Teacher has been successfully added.');
    }
}

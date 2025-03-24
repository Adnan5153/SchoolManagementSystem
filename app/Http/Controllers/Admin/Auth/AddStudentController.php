<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AllStudent;
use App\Models\Student;
use App\Models\ParentModel;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AddStudentController extends Controller
{
    /**
     * Show the form for adding a new student and parent.
     */
    public function create()
    {
        $classes = ClassModel::all(); // Fetch all classes and sections
        return view('admin.layouts.addstudent', compact('classes'));
    }

    /**
     * Store a newly created student and parent in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data for student and parent
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id', // Ensure class_id exists
            'gender' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'student_id' => 'required|numeric|unique:allstudents,student_id',
            'admission_number' => 'nullable|string|max:50',
            'religion' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:allstudents,email|unique:students,email',

            // Parent fields
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_occupation' => 'required|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'parent_email' => 'required|email|max:255|unique:allparents,parent_email',
            'phone_number' => 'required|string|max:20',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // Fetch class and section from database
            $classData = ClassModel::findOrFail($validatedData['class_id']);

            // Check if the parent already exists
            $parent = ParentModel::firstOrCreate(
                ['parent_email' => $validatedData['parent_email']],
                [
                    'father_name' => $validatedData['father_name'],
                    'mother_name' => $validatedData['mother_name'],
                    'father_occupation' => $validatedData['father_occupation'],
                    'mother_occupation' => $validatedData['mother_occupation'],
                    'phone_number' => $validatedData['phone_number'],
                    'present_address' => $validatedData['present_address'],
                    'permanent_address' => $validatedData['permanent_address'],
                ]
            );

            // Create the student record in the allstudents table
            $allStudent = AllStudent::create([
                'student_id' => $validatedData['student_id'],
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'class_id' => $validatedData['class_id'],
                'class' => $classData->class_name, // Get class name from database
                'section' => $classData->section, // Get section from database
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'admission_number' => $validatedData['admission_number'],
                'religion' => $validatedData['religion'],
                'email' => $validatedData['email'],
                'parent_id' => $parent->id,
            ]);

            // Automatically create a student account with default password
            Student::create([
                'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make('12345678'), // Default password
                'class_id' => $validatedData['class_id'],
                'section' => $classData->section, // Store section from classes table
            ]);

            DB::commit();

            return redirect()->route('register.student.and.parent')
                ->with('success', 'Student and parent have been successfully added. Student account created with default password: 12345678');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error while adding student and parent: ' . $e->getMessage());

            return redirect()->route('register.student.and.parent')
                ->with('error', 'An error occurred while adding the student and parent. Please try again.');
        }
    }
}
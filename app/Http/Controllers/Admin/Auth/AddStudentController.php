<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AllStudent;
use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddStudentController extends Controller
{
    /**
     * Show the form for adding a new student and parent.
     */
    public function create()
    {
        return view('admin.layouts.addstudent');
    }

    /**
     * Store a newly created student and parent in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data for both student and parent
        $validatedData = $request->validate([
            // Student fields
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'class' => 'required|string|max:10',
            'section' => 'required|string|max:10',
            'gender' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'student_id' => 'required|numeric|unique:allstudents,student_id',
            'admission_number' => 'nullable|string|max:50',
            'religion' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:allstudents,email',

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

            // Create the student record
            AllStudent::create([
                'student_id' => $validatedData['student_id'],
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'class' => $validatedData['class'],
                'section' => $validatedData['section'],
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'admission_number' => $validatedData['admission_number'],
                'religion' => $validatedData['religion'],
                'email' => $validatedData['email'],
                'parent_id' => $parent->id,
            ]);

            DB::commit();

            // Redirect with a success message
            return redirect()->route('register.student.and.parent')
                ->with('success', 'Student and parent have been successfully added.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error while adding student and parent: ' . $e->getMessage());

            // Redirect with an error message
            return redirect()->route('register.student.and.parent')
                ->with('error', 'An error occurred while adding the student and parent. Please try again.');
        }
    }
}

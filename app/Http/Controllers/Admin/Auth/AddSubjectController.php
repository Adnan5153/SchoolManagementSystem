<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use App\Models\Teacher;
use App\Models\ClassModel; // Ensure we use the correct Class model

class AddSubjectController extends Controller
{
    /**
     * Display the subject management page.
     */
    public function index()
    {
        $classes = ClassModel::select('id', 'class_name', 'section')->get();
        $teachers = Teacher::select('id', 'name', 'email')->get();
        $subjects = Subject::with(['class', 'teacher'])->get();

        return view('admin.layouts.addsubject', compact('classes', 'teachers', 'subjects'));
    }

    /**
     * Store a new subject.
     */
    public function store(Request $request)
    {

        // Log request data for debugging
        Log::info('Subject Form Data:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        // Ensure the subject is unique for that class-section
        $existingSubject = Subject::where('name', $request->name)
            ->where('class_id', $request->class_id)
            ->first();

        if ($existingSubject) {
            return back()->withErrors(['error' => 'This subject is already assigned to this class and section.'])->withInput();
        }

        // Create Subject with assigned Teacher
        $subject = Subject::create([
            'name' => $request->name,
            'class_id' => $request->class_id,
            'teacher_id' => $request->teacher_id, // Ensure teacher ID is passed
        ]);

        Log::info('New Subject Created:', $subject->toArray());

        return redirect()->route('subjects.index')->with('success', 'Subject and teacher assigned successfully.');
    }


    /**
     * Show the edit form for a subject.
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $classes = ClassModel::select('id', 'class_name', 'section')->get();

        return view('admin.layouts.edit_subject', compact('subject', 'classes'));
    }

    /**
     * Update an existing subject.
     */
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        // Ensure the subject remains unique per class-section
        $existingSubject = Subject::where('name', $request->name)
            ->where('class_id', $request->class_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingSubject) {
            return back()->withErrors(['error' => 'This subject is already assigned to this class and section.'])->withInput();
        }

        $subject->update([
            'name' => $request->name,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    /**
     * Delete a subject.
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }

    /**
     * AJAX Filter: Fetch subjects based on selected class-section.
     */
    public function filterSubjects(Request $request)
    {
        $classId = $request->query('class_id');

        if ($classId) {
            $subjects = Subject::where('class_id', $classId)
                ->with(['class', 'teacher']) // ✅ Ensure teacher relationship is included
                ->get();
        } else {
            $subjects = Subject::with(['class', 'teacher'])->get();
        }

        // ✅ Ensure the teacher's name is included in the response
        return response()->json($subjects->map(function ($subject) {
            return [
                'id' => $subject->id,
                'name' => $subject->name,
                'class_name' => $subject->class->class_name ?? 'Not Assigned',
                'section' => $subject->class->section ?? 'Not Assigned',
                'teacher_name' => $subject->teacher->name ?? 'No Teacher Assigned', // ✅ Ensure teacher name is included
            ];
        }));
    }
}

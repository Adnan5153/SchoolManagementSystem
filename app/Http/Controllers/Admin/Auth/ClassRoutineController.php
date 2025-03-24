<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoutine;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Teacher;

class ClassRoutineController extends Controller
{
    /**
     * Display all class routines.
     */
    public function index()
    {
        $class_routines = ClassRoutine::with(['class', 'subject', 'teacher'])->get();
        return view('admin.layouts.allclassroutines', compact('class_routines'));
    }

    /**
     * Show form to add a new class routine.
     */
    public function create()
    {
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $class_routines = ClassRoutine::all();

        return view('admin.layouts.addclassroutine', compact('classes', 'subjects', 'teachers', 'class_routines'));
    }

    /**
     * Store a newly created class routine.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id', 
            'day_of_week' => 'required|string|max:10',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'nullable|string|max:10',
        ], [
            'end_time.after' => 'The end time must be after the start time.',
        ]);

        // ✅ Ensure teacher is not assigned to another class at the same time
        $conflict = ClassRoutine::where('teacher_id', $request->teacher_id)
            ->where('day_of_week', $request->day_of_week)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors([
                'conflict' => 'This teacher is already assigned to another class at the same time.'
            ])->withInput();
        }

        //  Store Class Routine 
        ClassRoutine::create([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'room_number' => $request->room_number,
        ]);

        return redirect()->route('classroutines.index')->with('success', 'Class routine added successfully.');
    }

    /**
     * Show the form for editing a class routine.
     */
    public function edit($id)
    {
        $class_routine = ClassRoutine::findOrFail($id);
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('admin.layouts.editclassroutine', compact('class_routine', 'classes', 'subjects', 'teachers'));
    }

    /**
     * Update an existing class routine.
     */
    public function update(Request $request, $id)
    {
        $class_routine = ClassRoutine::findOrFail($id);

        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id', // ✅ Correct field
            'day_of_week' => 'required|string|max:20',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'nullable|string|max:20',
        ]);

        $class_routine->update([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id, // ✅ Correct field
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'room_number' => $request->room_number,
        ]);

        return redirect()->route('classroutines.index')->with('success', 'Class routine updated successfully.');
    }

    /**
     * Get subjects based on selected class (AJAX request).
     */
    public function getSubjectsByClass(Request $request)
    {
        $subjects = Subject::where('class_id', $request->class_id)->get();

        return response()->json($subjects);
    }

    /**
     * Delete a class routine.
     */
    public function destroy($id)
    {
        $class_routine = ClassRoutine::findOrFail($id);
        $class_routine->delete();

        return redirect()->route('classroutines.index')->with('success', 'Class routine deleted successfully.');
    }
}

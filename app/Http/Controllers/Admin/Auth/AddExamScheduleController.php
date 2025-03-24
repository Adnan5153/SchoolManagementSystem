<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamSchedule;
use App\Models\ClassModel;
use App\Models\Subject;

class AddExamScheduleController extends Controller
{
    /**
     * Show the form for creating exam schedule.
     */
    public function index()
    {
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $examSchedules = ExamSchedule::with(['class', 'subject'])->get();

        return view('admin.layouts.addexamschedule', compact('classes', 'subjects', 'examSchedules'));
    }

    /**
     * Store a new exam schedule.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'nullable|string|max:20',
        ], [
            'exam_date.after_or_equal' => 'Exam date cannot be in the past.',
            'end_time.after' => 'End time must be after start time.',
        ]);

        // Prevent exam schedule conflicts
        $conflict = ExamSchedule::where('class_id', $request->class_id)
            ->where('exam_date', $request->exam_date)
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
            return back()->withErrors(['conflict' => 'This exam schedule conflicts with another exam.'])->withInput();
        }

        ExamSchedule::create($request->all());

        return redirect()->route('examschedule.index')->with('success', 'Exam schedule added successfully.');
    }

    public function show()
    {
        $examSchedules = ExamSchedule::with(['class', 'subject'])->get();

        return view('admin.layouts.examschedulelist', compact('examSchedules'));
    }

    public function edit($id)
    {
        $examSchedule = ExamSchedule::findOrFail($id);
        $classes = ClassModel::all();
        $subjects = Subject::where('class_id', $examSchedule->class_id)->get(); // Fetch subjects assigned to the selected class

        return view('admin.layouts.modal.editexamschedule', compact('examSchedule', 'classes', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $examSchedule = ExamSchedule::findOrFail($id);

        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_number' => 'nullable|string|max:20',
        ], [
            'exam_date.after_or_equal' => 'Exam date cannot be in the past.',
            'end_time.after' => 'End time must be after start time.',
        ]);

        $examSchedule->update($request->all());

        return redirect()->route('examschedule.list')->with('success', 'Exam schedule updated successfully.');
    }


    public function getSubjectsByClass(Request $request)
    {
        $classId = $request->query('class_id');

        if (!$classId) {
            return response()->json(['error' => 'No class selected'], 400);
        }

        // Fetch subjects assigned to the selected class
        $subjects = Subject::where('class_id', $classId)->get();

        if ($subjects->isEmpty()) {
            return response()->json(['message' => 'No subjects found for this class'], 200);
        }

        return response()->json($subjects);
    }
}

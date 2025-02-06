<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassModel; // Ensure we use the correct Class model

class AddSubjectController extends Controller
{
    /**
     * Display the subject management page.
     */
    public function index()
    {
        // Fetch all classes
        $classes = ClassModel::select('id', 'class_name')->get();

        // Fetch all subjects with their assigned classes
        $subjects = Subject::with('class')->get();

        return view('admin.layouts.addsubject', compact('classes', 'subjects'));
    }

    /**
     * Store a new subject.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ]);

        // Ensure the subject is unique for that class
        $existingSubject = Subject::where('name', $request->name)->where('class_id', $request->class_id)->first();
        if ($existingSubject) {
            return back()->withErrors(['error' => 'This subject is already assigned to this class.'])->withInput();
        }

        Subject::create([
            'name' => $request->name,
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully.');
    }

    /**
     * Show the edit form for a subject.
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $classes = ClassModel::select('id', 'class_name')->get();

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

        // Ensure the subject remains unique per class
        $existingSubject = Subject::where('name', $request->name)->where('class_id', $request->class_id)->where('id', '!=', $id)->first();
        if ($existingSubject) {
            return back()->withErrors(['error' => 'This subject is already assigned to this class.'])->withInput();
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
}

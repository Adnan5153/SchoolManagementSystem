<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Mark;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $marks = Mark::with('allstudent')->get();
        $grades = Grade::all();
        return view('teacher.layouts.progress', compact('marks', 'grades'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'marks' => 'required|integer|min:0|max:100',
            'remarks' => 'nullable|string|max:255'
        ]);

        $mark = Mark::findOrFail($id);
        $mark->update([
            'marks' => $request->marks,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('teacher.progress')->with('success', 'Marks updated successfully.');
    }

    public function destroy($id)
    {
        $mark = Mark::findOrFail($id);
        $mark->delete();

        return redirect()->route('teacher.progress')->with('success', 'Marks deleted successfully.');
    }
}

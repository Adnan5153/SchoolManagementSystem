<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\ClassModel; // Updated class model reference
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $classes = ClassModel::all(); // Fetch all classes
        return view('teacher.auth.register', compact('classes'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:teachers,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'class_section' => ['required'], // Validate merged Class & Section dropdown
        ]);

        // Extract class_id and section from merged input
        list($classId, $section) = explode('|', $request->class_section);

        // Ensure the selected section is valid for the chosen class
        $validSection = ClassModel::where('id', $classId)->where('section', $section)->exists();
        if (!$validSection) {
            return back()->withErrors(['class_section' => 'Invalid class-section selection.']);
        }

        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'class_id' => $classId, // Assign class_id
            'section' => $section,  // Assign section
        ]);

        event(new Registered($teacher));

        Auth::guard('teacher')->login($teacher);

        return redirect(route('teacher.dashboard', absolute: false));
    }
}

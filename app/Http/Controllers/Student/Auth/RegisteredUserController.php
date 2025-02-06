<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view with available classes and sections.
     */
    public function create(): View
    {
        $classes = ClassModel::all(); // Fetch all classes

        return view('student.auth.register', compact('classes'));
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:students,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'class_id' => ['required', 'exists:classes,id'], // Validate class_id
            'section' => ['required', 'string', 'max:10'], // Ensure section is provided
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'class_id' => $request->class_id, // Store class_id
            'section' => $request->section, // Store section
        ]);

        event(new Registered($student));

        Auth::guard('student')->login($student);

        return redirect(route('student.dashboard', absolute: false));
    }
}

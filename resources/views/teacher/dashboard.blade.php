@extends('layouts.teacher')

@section('content')

@php
use Illuminate\Support\Facades\Auth;
use App\Models\ClassRoutine;
use App\Models\AllStudent;

// ✅ Get the logged-in teacher
$teacher = Auth::user();

// ✅ Fetch total classes assigned to this teacher
$totalClasses = ClassRoutine::where('teacher_id', $teacher->id)->count();

// ✅ Fetch all class IDs where this teacher has classes
$classIds = ClassRoutine::where('teacher_id', $teacher->id)
    ->pluck('class_id')
    ->unique()
    ->filter()
    ->toArray();

// ✅ Fetch total students in the teacher's classes
$totalStudents = !empty($classIds)
    ? AllStudent::whereIn('class_id', $classIds)->count()
    : 0;

// ✅ Fetch upcoming classes today
$upcomingClassesToday = ClassRoutine::where('teacher_id', $teacher->id)
    ->where('day_of_week', now()->format('l')) // Get today's day name
    ->count();
@endphp

<div class="row mt-5">
    <!-- Total Classes Assigned -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title">Total Classes Assigned</h5>
                <h3 class="text-primary">{{ $totalClasses }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Students Under Supervision -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title">Total Students Under Supervision</h5>
                <h3 class="text-success">{{ $totalStudents }}</h3>
            </div>
        </div>
    </div>

    <!-- Upcoming Classes Today -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h5 class="card-title">Upcoming Classes Today</h5>
                <h3 class="text-danger">{{ $upcomingClassesToday }}</h3>
            </div>
        </div>
    </div>
</div>

@endsection

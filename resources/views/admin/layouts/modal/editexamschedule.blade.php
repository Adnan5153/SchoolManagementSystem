@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Exam Schedule</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('examschedule.update', $examSchedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="class_id" class="form-label">Select Class</label>
            <select class="form-select" id="class_id" name="class_id" required>
                <option value="" selected disabled>Select a class</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ $class->id == $examSchedule->class_id ? 'selected' : '' }}>
                    {{ $class->class_name }} - {{ $class->section }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Select Subject</label>
            <select class="form-select" id="subject_id" name="subject_id" required>
                <option value="" selected disabled>Select a subject</option>
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ $subject->id == $examSchedule->subject_id ? 'selected' : '' }}>
                    {{ $subject->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="exam_date" class="form-label">Exam Date</label>
            <input type="date" class="form-control" id="exam_date" name="exam_date" value="{{ $examSchedule->exam_date }}" required>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $examSchedule->start_time }}" required>
            </div>
            <div class="col-md-6">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $examSchedule->end_time }}" required>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label for="room_number" class="form-label">Room Number (Optional)</label>
            <input type="text" class="form-control" id="room_number" name="room_number" value="{{ $examSchedule->room_number }}" placeholder="Enter room number">
        </div>

        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Update Schedule</button>
    </form>
</div>
@endsection

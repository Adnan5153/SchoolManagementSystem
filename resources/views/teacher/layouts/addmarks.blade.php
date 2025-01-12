@extends('layouts.teacher')

@section('content')
<div class="container mt-5">
    <h3>Add Marks for Students</h3>

    <form action="{{ route('teacher.storemarks') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select class="form-select" id="student_id" name="student_id" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->student_id }}">{{ $student->first_name }} {{ $student->last_name }} (ID: {{ $student->student_id }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
        </div>

        <div class="mb-3">
            <label for="marks" class="form-label">Marks</label>
            <input type="number" class="form-control" id="marks" name="marks" placeholder="Enter marks" min="0" max="100" required>
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="Optional remarks"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Marks</button>
    </form>
</div>
@endsection

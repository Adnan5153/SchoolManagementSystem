@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Add Exam Schedule</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('examschedule.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="class_id" class="form-label">Select Class</label>
            <select class="form-select" id="class_id" name="class_id" required>
                <option value="" selected disabled>Select a class</option>
                @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->class_name }} - {{ $class->section }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Select Subject</label>
            <select class="form-select" id="subject_id" name="subject_id" required>
                <option value="" selected disabled>Select a subject</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="exam_date" class="form-label">Exam Date</label>
            <input type="date" class="form-control" id="exam_date" name="exam_date" required>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="col-md-6">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" required>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label for="room_number" class="form-label">Room Number (Optional)</label>
            <input type="text" class="form-control" id="room_number" name="room_number" placeholder="Enter room number">
        </div>

        <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add Schedule</button>
    </form>
</div>

<!-- JavaScript for Dynamic Subject Filtering -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let classDropdown = document.getElementById("class_id");
        let subjectDropdown = document.getElementById("subject_id");

        if (!classDropdown || !subjectDropdown) {
            console.error("Dropdown elements not found!");
            return;
        }

        classDropdown.addEventListener("change", function() {
            let classId = this.value;

            // Reset subject dropdown
            subjectDropdown.innerHTML = '<option value="" selected disabled>Select a subject</option>';

            if (classId) {
                fetch(`/admin/examschedule/get-subjects?class_id=${classId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Subjects received:", data);

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(subject => {
                                let option = document.createElement("option");
                                option.value = subject.id;
                                option.textContent = subject.name;
                                subjectDropdown.appendChild(option);
                            });
                        } else {
                            let option = document.createElement("option");
                            option.textContent = "No subjects available";
                            subjectDropdown.appendChild(option);
                        }
                    })
                    .catch(error => console.error("Error fetching subjects:", error));
            }
        });
    });
</script>
@endsection
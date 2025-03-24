@extends('layouts.admin')

@section('content')
<div class="row mt-5">
    <div class="col-md-9">
        <!-- Add Class Routine Section -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fa-solid fa-calendar-plus"></i> Add Class Routine</h4>
            </div>
            <div class="card-body">
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

                <form action="{{ route('classroutines.store') }}" method="POST">
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
                        <label for="teacher_id" class="form-label">Select Teacher</label>
                        <select class="form-select" id="teacher_id" name="teacher_id" required>
                            <option value="" selected disabled>Select a teacher</option>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="day_of_week" class="form-label">Day of the Week</label>
                        <select class="form-select" id="day_of_week" name="day_of_week" required>
                            <option value="" selected disabled>Select a day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
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

                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add Routine</button>
                </form>
            </div>
        </div>

        <!-- List of Class Routines -->
        <div class="card mt-4 shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fa-solid fa-list"></i> Class Routine List</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Room</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($class_routines as $routine)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $routine->class->class_name }} - {{ $routine->class->section }}</td>
                            <td>{{ $routine->subject->name }}</td>
                            <td>{{ $routine->teacher->first_name }} {{ $routine->teacher->last_name }}</td>
                            <td>{{ $routine->day_of_week }}</td>
                            <td>{{ \Carbon\Carbon::parse($routine->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($routine->end_time)->format('h:i A') }}</td>
                            <td>{{ $routine->room_number ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('classroutines.edit', $routine->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('classroutines.destroy', $routine->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div> <!-- End of Main Content -->
</div>
<!-- AJAX Script to Fetch Subjects Based on Selected Class -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let classDropdown = document.getElementById("class_id");
        let subjectDropdown = document.getElementById("subject_id");

        if (!classDropdown || !subjectDropdown) {
            console.error("Dropdown elements not found!");
            return; // Stop execution if elements are missing
        }

        classDropdown.addEventListener("change", function() {
            let classId = this.value;

            // Reset subject dropdown
            subjectDropdown.innerHTML = '<option value="" selected disabled>Select a subject</option>';

            if (classId) {
                fetch(`/admin/classroutines/get-subjects?class_id=${classId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Subjects received:", data); // Debugging line

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
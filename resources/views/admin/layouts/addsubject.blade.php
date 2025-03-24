@extends('layouts.admin')

@section('content')

<div class="row mt-4">
    <!-- Manage Subject Form -->
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fa-solid fa-book"></i> Manage Subjects</h4>
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

                <form action="{{ route('subjects.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter subject name" required>
                    </div>

                    <div class="mb-3">
                        <label for="class_id" class="form-label">Assign to Class & Section</label>
                        <select class="form-select" id="class_id" name="class_id" required>
                            <option value="" selected disabled>Select a class & section</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->id }}">
                                {{ $class->class_name }} {{ $class->section ? '- ' . $class->section : '' }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="teacher_id" class="form-label">Assign Teacher</label>
                        <select class="form-select" id="teacher_id" name="teacher_id" required>
                            <option value="" selected disabled>Select a teacher</option>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">
                                {{ $teacher->name }} - {{ $teacher->email }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-plus"></i> Add Subject</button>
                </form>
            </div>
        </div>
    </div>

    <!-- List of Subjects with Filtering -->
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa-solid fa-list"></i> List of Subjects</h5>
                <select class="form-select w-auto" id="filter_class">
                    <option value="">Filter by Class & Section</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">
                        {{ $class->class_name }} {{ $class->section ? '- ' . $class->section : '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Subject Name</th>
                            <th>Assigned Class</th>
                            <th>Assigned Teacher</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="subjectTable">
                        @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->class->class_name ?? 'Not Assigned' }} - {{ $subject->class->section ?? 'Not Assigned' }}</td>
                            <td>{{ $subject->teacher->name ?? 'No Teacher Assigned' }}</td>
                            <td>
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
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
    </div>
</div>

<!-- JavaScript to Filter Subjects -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let filterClassDropdown = document.getElementById("filter_class");
        let subjectTableBody = document.getElementById("subjectTable");

        if (filterClassDropdown) {
            filterClassDropdown.addEventListener("change", function() {
                let classId = this.value;

                fetch(`/admin/subjects/filter?class_id=${classId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        subjectTableBody.innerHTML = "";

                        if (data.length > 0) {
                            data.forEach((subject, index) => {
                                let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${subject.name}</td>
                                <td>${subject.class_name} - ${subject.section}</td>
                                <td>${subject.teacher_name ? subject.teacher_name : 'No Teacher Assigned'}</td>
                                <td>
                                    <a href="/admin/subjects/edit/${subject.id}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="/admin/subjects/destroy/${subject.id}" method="POST" class="d-inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>`;
                                subjectTableBody.innerHTML += row;
                            });
                        } else {
                            subjectTableBody.innerHTML = `<tr><td colspan="5" class="text-center">No subjects found</td></tr>`;
                        }
                    })
                    .catch(error => console.error("Error fetching subjects:", error));
            });
        }
    });
</script>

@endsection
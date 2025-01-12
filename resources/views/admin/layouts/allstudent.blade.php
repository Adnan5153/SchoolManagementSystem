@extends('layouts.admin')
@section('content')

<div class="container mt-5">
    <div class="row g-3 justify-content-end" style="align-content: center;">
        <div class="col-md-2">
            <input type="text" class="form-control mb-3 p-1" style="border-radius: 20px; font-size:small;" placeholder="Search Roll Number">
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control mb-3 p-1" style="border-radius: 20px; font-size:small;" placeholder="Search Section">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary btn-sm" style="border-radius: 20px;">Search Results</button>
        </div>
    </div>

    <!-- Responsive table container -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th class="font">Student ID</th>
                    <th class="font">Name</th>
                    <th class="font">Gender</th>
                    <th class="font">Father's Name</th>
                    <th class="font">Mother's Name</th>
                    <th class="font">Class</th>
                    <th class="font">Section</th>
                    <th class="font">Address</th>
                    <th class="font">Date of Birth</th>
                    <th class="font">Phone no</th>
                    <th class="font">E-mail</th>
                    <th class="font">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr class="font">
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ optional($student->parent)->father_name ?? 'N/A' }}</td>
                    <td>{{ optional($student->parent)->mother_name ?? 'N/A' }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->section }}</td>
                    <td>{{ optional($student->parent)->present_address ?? 'N/A' }}</td>
                    <td>{{ $student->date_of_birth }}</td>
                    <td>{{ optional($student->parent)->phone_number ?? 'N/A' }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <!-- Button that triggers the modal -->
                        <a href="#" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editStudentModal-{{ $student->student_id }}">
                            <i class="fa-solid fa-pen-to-square" style="color: #FFD43B;"></i>
                        </a>

                        <!-- Delete form -->
                        <form action="{{ route('allstudent.destroy', $student->student_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">
                                <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $students->links() }}
    </div>
</div>

<!-- Include the modal partial -->
@foreach($students as $student)
@include('admin.layouts.modal.edit', ['student' => $student, 'parent' => optional($student->parent)])
@endforeach

@endsection
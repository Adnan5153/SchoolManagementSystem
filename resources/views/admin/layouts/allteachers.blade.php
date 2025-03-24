@extends('layouts.admin')
@section('content')
<div class="container mt-5">
    <!-- Search Row -->
    <div class="row g-3 justify-content-end" style="align-content: center;">
        <div class="col-md-2">
            <input type="text" class="form-control mb-3 p-1" style="border-radius: 20px; font-size:small;" placeholder="Search Teachers">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary btn-sm" style="border-radius: 20px;">Search Results</button>
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="table-responsive">
        <table class="table">
            <!-- Table Headers -->
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Class</th>
                    <th scope="col">Section</th>
                    <th scope="col">Address</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Phone No</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody>
                @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                    <td>{{ $teacher->gender }}</td>
                    <td>{{ $teacher->subject }}</td>
                    <td>{{ $teacher->class->class_name ?? 'N/A' }}</td> <!-- ✅ fallback if null -->
                    <td>{{ $teacher->section }}</td>
                    <td>{{ $teacher->address }}</td>
                    <td>{{ $teacher->date_of_birth }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>
                        <!-- Edit Button to Open Modal -->
                        <a href="#" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editTeacherModal-{{ $teacher->id }}">
                            <i class="fa-solid fa-pen-to-square" style="color: #FFD43B;"></i>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('allteachers.destroy', $teacher->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this teacher?');">
                                <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for Editing Teacher Information -->
                <div class="modal fade" id="editTeacherModal-{{ $teacher->id }}" tabindex="-1" aria-labelledby="editTeacherLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTeacherLabel">Edit Teacher Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('allteachers.update', $teacher->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- First Name -->
                                    <div class="mb-3">
                                        <label for="first_name-{{ $teacher->id }}" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name-{{ $teacher->id }}" name="first_name" value="{{ $teacher->first_name }}" required>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="mb-3">
                                        <label for="last_name-{{ $teacher->id }}" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name-{{ $teacher->id }}" name="last_name" value="{{ $teacher->last_name }}" required>
                                    </div>

                                    <!-- Class -->
                                    <div class="mb-3">
                                        <label for="class-{{ $teacher->id }}" class="form-label">Class</label>
                                        <input type="text" class="form-control" id="class-{{ $teacher->id }}" name="class" value="{{ $teacher->class }}" required>
                                    </div>

                                    <!-- Section -->
                                    <div class="mb-3">
                                        <label for="section-{{ $teacher->id }}" class="form-label">Section</label>
                                        <input type="text" class="form-control" id="section-{{ $teacher->id }}" name="section" value="{{ $teacher->section }}" required>
                                    </div>

                                    <!-- Subject -->
                                    <div class="mb-3">
                                        <label for="subject-{{ $teacher->id }}" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="subject-{{ $teacher->id }}" name="subject" value="{{ $teacher->subject }}" required>
                                    </div>

                                    <!-- Gender -->
                                    <div class="mb-3">
                                        <label for="gender-{{ $teacher->id }}" class="form-label">Gender</label>
                                        <input type="text" class="form-control" id="gender-{{ $teacher->id }}" name="gender" value="{{ $teacher->gender }}" required>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="mb-3">
                                        <label for="date_of_birth-{{ $teacher->id }}" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="date_of_birth-{{ $teacher->id }}" name="date_of_birth" value="{{ $teacher->date_of_birth }}" required>
                                    </div>

                                    <!-- Joining Date -->
                                    <div class="mb-3">
                                        <label for="joining_date-{{ $teacher->id }}" class="form-label">Joining Date</label>
                                        <input type="date" class="form-control" id="joining_date-{{ $teacher->id }}" name="joining_date" value="{{ $teacher->joining_date }}" required>
                                    </div>

                                    <!-- NID Number -->
                                    <div class="mb-3">
                                        <label for="nid_number-{{ $teacher->id }}" class="form-label">NID Number</label>
                                        <input type="text" class="form-control" id="nid_number-{{ $teacher->id }}" name="nid_number" value="{{ $teacher->nid_number }}">
                                    </div>

                                    <!-- Religion -->
                                    <div class="mb-3">
                                        <label for="religion-{{ $teacher->id }}" class="form-label">Religion</label>
                                        <input type="text" class="form-control" id="religion-{{ $teacher->id }}" name="religion" value="{{ $teacher->religion }}" required>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <label for="email-{{ $teacher->id }}" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email-{{ $teacher->id }}" name="email" value="{{ $teacher->email }}" required>
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="mb-3">
                                        <label for="phone-{{ $teacher->id }}" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone-{{ $teacher->id }}" name="phone" value="{{ $teacher->phone }}" required>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-3">
                                        <label for="address-{{ $teacher->id }}" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address-{{ $teacher->id }}" name="address" value="{{ $teacher->address }}" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $teachers->links() }}
    </div>
</div>
@endsection
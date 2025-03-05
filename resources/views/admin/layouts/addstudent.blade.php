@extends('layouts.admin')
@section('content')
<style>

</style>

<div class="form-container">
    <!-- Flash Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Form Header -->
    <div class="form-heading">
        <h3>Add Student Form</h3>
        <p>Student Information</p>
    </div>

    <!-- Form Section -->
    <form action="{{ route('register.student.and.parent.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
            </div>
            <div class="col-md-6">
                <label for="class_id" class="form-label">Class & Section</label>
                <select class="form-select" id="class_id" name="class_id" required>
                    <option value="">Select Class & Section</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }} - {{ $class->section }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
            </div>
            <div class="col-md-6">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="number" class="form-control" id="student_id" name="student_id" placeholder="Student ID" required>
            </div>
            <div class="col-md-6">
                <label for="admission_number" class="form-label">Admission Number</label>
                <input type="number" class="form-control" id="admission_number" name="admission_number" placeholder="Admission Number">
            </div>
            <div class="col-md-6">
                <label for="religion" class="form-label">Religion</label>
                <input type="text" class="form-control" id="religion" name="religion" placeholder="Religion" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" required>
            </div>
            <div>
                <br><br>
            </div>

            <!---------------------- Add Parents ---------------------->
            <!-- Form Header -->
            <div class="form-heading">
                <h3>Add Parent Form</h3>
                <p>Parent Information</p>
            </div>
            <div class="col-md-6">
                <label for="father_name" class="form-label">Father's Name</label>
                <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father's Name" required>
            </div>

            <div class="col-md-6">
                <label for="mother_name" class="form-label">Mother's Name</label>
                <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Mother's Name" required>
            </div>

            <div class="col-md-6">
                <label for="father_occupation" class="form-label">Father's Occupation</label>
                <input type="text" class="form-control" id="father_occupation" name="father_occupation" placeholder="Father Occupation" required>
            </div>
            <div class="col-md-6">
                <label for="mother_occupation" class="form-label">Mother Occupation</label>
                <input type="text" class="form-control" id="mother_occupation" name="mother_occupation" placeholder="Mother Occupation">
            </div>
            <div class="col-md-6">
                <label for="parent_email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="parent_email" name="parent_email" placeholder="example@mail.com" required>
            </div>
            <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" required>
            </div>
            <div class="col-md-6">
                <label for="present_address" class="form-label">Present Address</label>
                <input type="text" class="form-control" id="present_address" name="present_address" placeholder="Present Address" required>
            </div>
            <div class="col-md-6">
                <label for="permanent_address" class="form-label">Permanent Address</label>
                <input type="text" class="form-control" id="permanent_address" name="permanent_address" placeholder="Permanent Address" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection
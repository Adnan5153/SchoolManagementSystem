@extends('layouts.admin')
@section('content')
<style>

</style>

<div class="form-container">
    <!-- Form Header -->
    <div class="form-heading">
        <h3>Add Teacher Form</h3>
        <p>Teacher Information</p>
    </div>
    <!-- Form Section -->
    <form action="{{ route('addteacher.store') }}" method="POST">
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
                <label for="class_section" class="form-label">Select Class & Section</label>
                <select class="form-select" id="class_section" name="class_section" required>
                    <option value="" selected disabled>Select Class & Section</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}|{{ $class->section }}">
                        {{ $class->class_name }} - {{ $class->section }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-select" id="subject" name="subject" required>
                    <option value="">Select Subject</option>
                    <option value="Bangla">Bangla</option>
                    <option value="English">English</option>
                    <!-- Additional sections -->
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
                <label for="joining_date" class="form-label">Joining Date</label>
                <input type="date" class="form-control" id="joining_date" name="joining_date" required>
            </div>
            <div class="col-md-6">
                <label for="nid_number" class="form-label">NID Number</label>
                <input type="number" class="form-control" id="nid_number" name="nid_number" placeholder="NID Number">
            </div>
            <div class="col-md-6">
                <label for="religion" class="form-label">Religion</label>
                <input type="text" class="form-control" id="religion" name="religion" placeholder="Religion" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone No</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone No" required>
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
            </div>
            <div>
                <br><br>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-3 ms-1">Submit</button>
                <button type="reset" class="btn btn-danger mt-3 ms-1">Reset</button>
            </div>
        </div>
    </form>
</div>
@endsection
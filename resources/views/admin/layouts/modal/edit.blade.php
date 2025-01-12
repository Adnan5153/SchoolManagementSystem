<!-- Modal for editing student and parent information -->
<div class="modal fade" id="editStudentModal-{{ $student->student_id }}" tabindex="-1" aria-labelledby="editStudentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentLabel">Edit Student and Parent Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Ensure the form action is using the correct route for updating a student by student_id -->
                <form action="{{ route('allstudent.update', $student->student_id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- This ensures the form submission uses the PUT method -->

                    <!-- Student Information -->
                    <h5>Student Information</h5>
                    <div class="mb-3">
                        <label for="first_name-{{ $student->student_id }}" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name-{{ $student->student_id }}" name="first_name" value="{{ $student->first_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="last_name-{{ $student->student_id }}" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name-{{ $student->student_id }}" name="last_name" value="{{ $student->last_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="class-{{ $student->student_id }}" class="form-label">Class</label>
                        <input type="text" class="form-control" id="class-{{ $student->student_id }}" name="class" value="{{ $student->class }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="section-{{ $student->student_id }}" class="form-label">Section</label>
                        <input type="text" class="form-control" id="section-{{ $student->student_id }}" name="section" value="{{ $student->section }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender-{{ $student->student_id }}" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender-{{ $student->student_id }}" name="gender" value="{{ $student->gender }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth-{{ $student->student_id }}" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth-{{ $student->student_id }}" name="date_of_birth" value="{{ $student->date_of_birth }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="religion-{{ $student->student_id }}" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion-{{ $student->student_id }}" name="religion" value="{{ $student->religion }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email-{{ $student->student_id }}" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email-{{ $student->student_id }}" name="email" value="{{ $student->email }}" required>
                    </div>

                    <!-- Parent Information -->
                    <h5 class="mt-4">Parent Information</h5>

                    <div class="mb-3">
                        <label for="father_name-{{ $student->student_id }}" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="father_name-{{ $student->student_id }}" name="father_name" value="{{ $parent->father_name ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="mother_name-{{ $student->student_id }}" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="mother_name-{{ $student->student_id }}" name="mother_name" value="{{ $parent->mother_name ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="present_address-{{ $student->student_id }}" class="form-label">Present Address</label>
                        <input type="text" class="form-control" id="present_address-{{ $student->student_id }}" name="present_address" value="{{ $parent->present_address ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number-{{ $student->student_id }}" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number-{{ $student->student_id }}" name="phone_number" value="{{ $parent->phone_number ?? '' }}" required>
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
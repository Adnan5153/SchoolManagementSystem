<!-- Modal for editing teacher information -->
<div class="modal fade" id="editTeacherModal-{{ $teacher->teacher_id_number }}" tabindex="-1" aria-labelledby="editTeacherLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeacherLabel">Edit Teacher Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to edit teacher details -->
                <form action="{{ route('allteachers.update', $teacher->teacher_id_number) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- This ensures the form submission uses the PUT method -->

                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="first_name-{{ $teacher->teacher_id_number }}" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name-{{ $teacher->teacher_id_number }}" name="first_name" value="{{ $teacher->first_name }}" required>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="last_name-{{ $teacher->teacher_id_number }}" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name-{{ $teacher->teacher_id_number }}" name="last_name" value="{{ $teacher->last_name }}" required>
                    </div>

                    <!-- Class -->
                    <div class="mb-3">
                        <label for="class-{{ $teacher->teacher_id_number }}" class="form-label">Class</label>
                        <input type="text" class="form-control" id="class-{{ $teacher->teacher_id_number }}" name="class" value="{{ $teacher->class }}" required>
                    </div>

                    <!-- Section -->
                    <div class="mb-3">
                        <label for="section-{{ $teacher->teacher_id_number }}" class="form-label">Section</label>
                        <input type="text" class="form-control" id="section-{{ $teacher->teacher_id_number }}" name="section" value="{{ $teacher->section }}" required>
                    </div>

                    <!-- Subject -->
                    <div class="mb-3">
                        <label for="subject-{{ $teacher->teacher_id_number }}" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject-{{ $teacher->teacher_id_number }}" name="subject" value="{{ $teacher->subject }}" required>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label for="gender-{{ $teacher->teacher_id_number }}" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender-{{ $teacher->teacher_id_number }}" name="gender" value="{{ $teacher->gender }}" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label for="date_of_birth-{{ $teacher->teacher_id_number }}" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth-{{ $teacher->teacher_id_number }}" name="date_of_birth" value="{{ $teacher->date_of_birth }}" required>
                    </div>

                    <!-- Joining Date -->
                    <div class="mb-3">
                        <label for="joining_date-{{ $teacher->teacher_id_number }}" class="form-label">Joining Date</label>
                        <input type="date" class="form-control" id="joining_date-{{ $teacher->teacher_id_number }}" name="joining_date" value="{{ $teacher->joining_date }}" required>
                    </div>

                    <!-- NID Number -->
                    <div class="mb-3">
                        <label for="nid_number-{{ $teacher->teacher_id_number }}" class="form-label">NID Number</label>
                        <input type="text" class="form-control" id="nid_number-{{ $teacher->teacher_id_number }}" name="nid_number" value="{{ $teacher->nid_number }}">
                    </div>

                    <!-- Religion -->
                    <div class="mb-3">
                        <label for="religion-{{ $teacher->teacher_id_number }}" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion-{{ $teacher->teacher_id_number }}" name="religion" value="{{ $teacher->religion }}" required>
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email-{{ $teacher->teacher_id_number }}" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email-{{ $teacher->teacher_id_number }}" name="email" value="{{ $teacher->email }}" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label for="phone-{{ $teacher->teacher_id_number }}" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone-{{ $teacher->teacher_id_number }}" name="phone" value="{{ $teacher->phone }}" required>
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="address-{{ $teacher->teacher_id_number }}" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address-{{ $teacher->teacher_id_number }}" name="address" value="{{ $teacher->address }}" required>
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

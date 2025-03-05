<!-- Modal for editing parent information -->
<div class="modal fade" id="editParentModal-{{ $parent->id }}" tabindex="-1" aria-labelledby="editParentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editParentLabel">Edit Parent Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Ensure the form action is using the correct route for updating a parent by id -->
                <form action="{{ route('allparents.update', $parent->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Parent Information -->
                    <div class="mb-3">
                        <label for="father_name-{{ $parent->id }}" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="father_name-{{ $parent->id }}" name="father_name" value="{{ $parent->father_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="mother_name-{{ $parent->id }}" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="mother_name-{{ $parent->id }}" name="mother_name" value="{{ $parent->mother_name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="father_occupation-{{ $parent->id }}" class="form-label">Father's Occupation</label>
                        <input type="text" class="form-control" id="father_occupation-{{ $parent->id }}" name="father_occupation" value="{{ $parent->father_occupation }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="mother_occupation-{{ $parent->id }}" class="form-label">Mother's Occupation</label>
                        <input type="text" class="form-control" id="mother_occupation-{{ $parent->id }}" name="mother_occupation" value="{{ $parent->mother_occupation }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="parent_email-{{ $parent->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="parent_email-{{ $parent->id }}" name="parent_email" value="{{ $parent->parent_email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number-{{ $parent->id }}" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number-{{ $parent->id }}" name="phone_number" value="{{ $parent->phone_number }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="present_address-{{ $parent->id }}" class="form-label">Present Address</label>
                        <input type="text" class="form-control" id="present_address-{{ $parent->id }}" name="present_address" value="{{ $parent->present_address }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="permanent_address-{{ $parent->id }}" class="form-label">Permanent Address</label>
                        <input type="text" class="form-control" id="permanent_address-{{ $parent->id }}" name="permanent_address" value="{{ $parent->permanent_address }}" required>
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
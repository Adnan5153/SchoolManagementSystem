@extends('layouts.teacher')

@section('content')
    <div class="container mt-5">
        <h3>Add Marks for Students</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('teacher.storemarks') }}" method="POST">
            @csrf

            {{-- Class + Section Dropdown --}}
            <div class="mb-3">
                <label for="class_section" class="form-label">Class - Section</label>
                <select class="form-select" id="class_section" required>
                    <option value="">Select Class - Section</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}|{{ $class->section }}">
                            {{ $class->class_name }} - {{ $class->section }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="student_id" class="form-label">Student</label>
                <select class="form-select" id="student_id" name="student_id" required>
                    <option value="">Select Student</option>
                </select>
            </div>

            {{-- Subject Dropdown --}}
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-select" id="subject" name="subject" required>
                    <option value="">Select Subject</option>
                </select>
            </div>


            {{-- Marks --}}
            <div class="mb-3">
                <label for="marks" class="form-label">Marks</label>
                <input type="number" class="form-control" id="marks" name="marks" placeholder="Enter marks"
                    min="0" max="100" required>
            </div>

            {{-- Remarks --}}
            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="Optional remarks"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Marks</button>
        </form>
    </div>

    {{-- AJAX Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const classSectionDropdown = document.getElementById('class_section');

            classSectionDropdown.addEventListener('change', function() {
                const [classId, section] = this.value.split('|');

                if (classId && section) {
                    // Fetch Students
                    fetch("{{ route('teacher.fetchstudents') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                class_id: classId,
                                section: section
                            })
                        })
                        .then(res => res.json())
                        .then(students => {
                            const studentSelect = document.getElementById('student_id');
                            studentSelect.innerHTML = '<option value="">Select Student</option>';
                            students.forEach(student => {
                                const option = document.createElement('option');
                                option.value = student.id;
                                option.textContent = `${student.name} (ID: ${student.id})`;
                                studentSelect.appendChild(option);
                            });
                        });

                    // Fetch Subjects
                    fetch("{{ route('teacher.fetchsubjects') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                class_id: classId
                            })
                        })
                        .then(res => res.json())
                        .then(subjects => {
                            const subjectSelect = document.getElementById('subject');
                            subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                            subjects.forEach(subject => {
                                const option = document.createElement('option');
                                option.value = subject.name;
                                option.textContent = subject.name;
                                subjectSelect.appendChild(option);
                            });
                        });
                }
            });
        });
    </script>
@endsection

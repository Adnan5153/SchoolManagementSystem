@extends('layouts.teacher')

@section('content')
    <h3 class="mb-4 mt-4">Student List</h3>

    {{-- 📋 Table --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <h5 class="mb-0"><i class="fa-solid fa-users"></i> Students</h5>

                <div class="d-flex flex-wrap align-items-center gap-2 ">
                    {{-- 🔍 Search Bar --}}
                    <input type="text" id="studentSearch" class="rounded-pill align-middle"
                        placeholder="Search by name or email..." style="width: 220px; padding: 5px 10px;">


                    {{-- 🔽 Class Filter Dropdown --}}
                    <select class="form-select form-select-sm rounded-pill" id="classFilter" style="width: 140px;">
                        <option value="">Class</option>
                        @foreach ($students->pluck('class')->unique() as $class)
                            <option value="{{ $class }}">{{ $class }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            {{-- make the table edge rouded --}}
            <div class="table-responsive p-3">
                <table class="table table-bordered table-hover mb-0" id="studentTable">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Gender</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->class }}</td>
                                <td>{{ $student->section }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-light d-flex justify-content-between align-items-center py-2 px-3 flex-wrap"
            style="gap: 1rem;">
            {{-- 👥 Student Count --}}
            <div class="text-muted small">
                Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} students
            </div>

            {{-- 📄 Pagination Links --}}
            <div class="mt-2 mt-md-0" style="display: flex; flex-wrap: wrap; gap: 4px;">
                {{-- Inline CSS for pagination links --}}
                {{ $students->links('pagination::simple-bootstrap-5') }}
                <style>
                    .pagination .page-link {
                        padding: 0.25rem 0.5rem !important;
                        font-size: 0.8rem !important;
                    }

                    .pagination .page-item:not(:last-child) {
                        margin-right: 4px !important;
                    }
                </style>
            </div>
        </div>
    </div>


    </div>

    {{-- 🔍 Filter Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('studentSearch');
            const classFilter = document.getElementById('classFilter');
            const rows = document.querySelectorAll('#studentTable tbody tr');

            function filterTable() {
                const keyword = searchInput.value.toLowerCase();
                const selectedClass = classFilter.value;

                rows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    const rowClass = row.children[3]?.textContent.trim();

                    const matchesSearch = rowText.includes(keyword);
                    const matchesClass = !selectedClass || rowClass === selectedClass;

                    row.style.display = matchesSearch && matchesClass ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterTable);
            classFilter.addEventListener('change', filterTable);
        });
    </script>
@endsection

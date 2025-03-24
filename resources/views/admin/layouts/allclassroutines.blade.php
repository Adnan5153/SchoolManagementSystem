@extends('layouts.admin')

@section('content')
<div class="row mt-5">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fa-regular fa-clipboard"></i> Class Routine List</h5>
            </div>
            <div class="card-body">

                <!-- Display Success Message -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Room</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($class_routines as $routine)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $routine->class->class_name }} - {{ $routine->class->section }}</td>
                            <td>{{ $routine->subject->name }}</td>
                            <td>{{ $routine->teacher->name ?? 'No Teacher Assigned' }}</td>
                            <td>{{ ucfirst($routine->day_of_week) }}</td>
                            <td>{{ \Carbon\Carbon::parse($routine->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($routine->end_time)->format('h:i A') }}</td>
                            <td>{{ $routine->room_number ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('classroutines.edit', $routine->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('classroutines.destroy', $routine->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No class routines available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
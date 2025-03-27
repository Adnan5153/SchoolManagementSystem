@extends('layouts.admin')

@section('content')
    <h3 class="mb-3">Exam Schedule List</h3>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        $grouped = $examSchedules->groupBy(function ($item) {
            return $item->class_id . '-' . $item->class->section;
        });
    @endphp

    @foreach ($grouped as $key => $group)
        @php
            $first = $group->first();
            $className = $first->class->class_name ?? 'Unknown';
            $section = $first->class->section ?? '';
        @endphp

        <div class="card shadow mb-4 w-100">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fa-solid fa-school"></i> Class {{ $className }} - {{ $section }}
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Exam Date</th>
                            <th>Time</th>
                            <th>Room</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->subject->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->exam_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} -
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                                <td>{{ $schedule->room_number ?? 'Not Assigned' }}</td>
                                <td>
                                    <a href="{{ route('examschedule.edit', $schedule->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('examschedule.destroy', $schedule->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
    </div>
@endsection

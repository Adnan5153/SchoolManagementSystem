@extends('layouts.student')

@section('content')
    <h3 class="mb-4 mt-4">My Exam Schedule</h3>

    @if ($examSchedules->isEmpty())
        <div class="alert alert-info">No exam schedules have been added yet for your class.</div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fa-solid fa-calendar-days"></i> Exam Schedule: {{ $examSchedules->first()->class->class_name }} - {{ $examSchedules->first()->class->section }}
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Exam Date</th>
                                <th>Time</th>
                                <th>Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($examSchedules as $schedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $schedule->subject->name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->exam_date)->format('d M Y') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                    </td>
                                    <td>{{ $schedule->room_number ?? 'Not Assigned' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

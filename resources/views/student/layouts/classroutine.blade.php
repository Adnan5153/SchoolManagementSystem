@extends('layouts.student')

@section('content')
    <h3 class="mb-4 mt-4">My Class Routine</h3>

    @if ($class_routines->isEmpty())
        <div class="alert alert-warning">No class routine is available for your class.</div>
    @else
        <div class="card shadow mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fa-solid fa-clipboard-list"></i> Class Routine - {{ $class_routines->first()->class->class_name ?? '' }} {{ $class_routines->first()->class->section ?? '' }}
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Day</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Time</th>
                                <th>Room</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($class_routines as $routine)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $routine->day_of_week }}</td>
                                    <td>{{ $routine->subject->name ?? 'N/A' }}</td>
                                    <td>{{ $routine->teacher->name ?? 'No Teacher Assigned' }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($routine->start_time)->format('h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($routine->end_time)->format('h:i A') }}
                                    </td>
                                    <td>{{ $routine->room_number ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

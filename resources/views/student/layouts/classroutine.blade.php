@extends('layouts.student')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10"> <!-- Adjust width to maintain responsiveness -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fa-solid fa-clipboard"></i> Class Routine</h4>
            </div>
            <div class="card-body">
                @if($class_routines->isEmpty())
                <div class="alert alert-warning text-center">No class routine available for your class.</div>
                @else
                <div class="table-responsive"> <!-- Fix table overflow issues -->
                    <table class="table table-bordered table-hover">
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
                                <td>{{ $routine->subject->name }}</td>
                                <td>{{ $routine->teacher->first_name }} {{ $routine->teacher->last_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($routine->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($routine->end_time)->format('h:i A') }}</td>
                                <td>{{ $routine->room_number ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
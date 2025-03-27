@extends('layouts.student')

@section('content')
    <h3 class="mb-4 mt-4">My Marks</h3>

    <div class="card shadow mt-5">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fa-solid fa-chart-simple"></i> Marks Summary</h5>
        </div>
        <div class="card-body">
            @if ($marks->isEmpty())
                <div class="alert alert-info">No marks available at this time.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Obtained Marks</th>
                                <th>GPA</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marks as $mark)
                                @php
                                    $grade = $grades->first(fn($g) => $mark->marks >= $g->min_marks && $mark->marks <= $g->max_marks);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mark->subject ?? 'N/A' }}</td>
                                    <td>{{ $mark->teacher->name ?? 'N/A' }}</td>
                                    <td>{{ $mark->marks }}</td>
                                    <td>{{ $grade->grade ?? 'N/A' }}</td>
                                    <td>{{ $mark->remarks ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

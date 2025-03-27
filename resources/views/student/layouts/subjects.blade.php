@extends('layouts.student')

@section('content')
    <h3 class="mb-4 mt-4">My Subjects</h3>

    <div class="card shadow mt-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fa-solid fa-book"></i> Subjects Assigned to Your Class</h5>
        </div>

        <div class="card-body">
            @if ($subjects->isEmpty())
                <div class="alert alert-info">No subjects assigned to your class yet.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <th>Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->teacher->name ?? 'Not Assigned' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

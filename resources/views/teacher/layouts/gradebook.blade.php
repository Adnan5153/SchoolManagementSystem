@extends('layouts.teacher')

@section('content')
    <h3 class="mb-4 mt-4">Grade Book</h3>
    <div class="card shadow mt-5">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fa-solid fa-list"></i> List of Grades</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Marks Range</th>
                        <th>Grade</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grade->min_marks }} - {{ $grade->max_marks }}</td>
                            <td>{{ $grade->grade }}</td>
                            <td>{{ $grade->remarks ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

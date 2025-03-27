@extends('layouts.teacher')

@section('content')
    <h3 class="mb-4 mt-4">Class List</h3>



    @forelse ($groupedClasses as $className => $classGroup)
        <div class="card shadow mb-4 w-100">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fa-solid fa-layer-group"></i> Class: {{ $className }}
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Section</th>
                            <th>Capacity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classGroup as $class)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $class->section }}</td>
                                <td>{{ $class->capacity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">No classes found.</div>
    @endforelse
@endsection

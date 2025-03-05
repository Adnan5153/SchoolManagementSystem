@extends('layouts.admin')

@section('content')

<div class="card shadow mt-5">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0"><i class="fa-solid fa-list"></i> List of Grades</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $grade->min_marks }} - {{ $grade->max_marks }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>{{ $grade->remarks ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-sm">
                            <i class="fa-solid fa-pen-to-square" style="color: #FFD43B;"></i> 
                        </a>
                        <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm">
                                <i class="fa-solid fa-trash" style="color: #ff0000;"></i> 
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
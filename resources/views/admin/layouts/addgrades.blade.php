@extends('layouts.admin')

@section('content')

<div class="card shadow mt-5">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fa-solid fa-plus"></i> Add Grade</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('grades.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="min_marks" class="form-label">Minimum Marks</label>
                <input type="number" class="form-control" id="min_marks" name="min_marks" required>
            </div>
            <div class="mb-3">
                <label for="max_marks" class="form-label">Maximum Marks</label>
                <input type="number" class="form-control" id="max_marks" name="max_marks" required>
            </div>
            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" class="form-control" id="grade" name="grade" required>
            </div>
            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks (Optional)</label>
                <input type="text" class="form-control" id="remarks" name="remarks">
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add Grade</button>
        </form>
    </div>
</div>

@endsection
@extends('layouts.admin')

@section('content')

<h3 class="mb-4 mt-4">Admin Dashboard</h3>

<div class="row">
    <!-- Students Card -->
    <div class="col-md-4">
        <div class="card shadow-lg border-0 mt-4">
            <div class="card-body text-center">
                <i class="fa-solid fa-user-graduate fa-2x text-primary"></i>
                <h6 class="mt-2">Total Students</h6>
                <h4 class="fw-bold">
                    {{ \App\Models\AllStudent::count() }}
                </h4>
            </div>
        </div>
    </div>

    <!-- Teachers Card -->
    <div class="col-md-4">
        <div class="card shadow-lg border-0 mt-4">
            <div class="card-body text-center">
                <i class="fa-solid fa-chalkboard-teacher fa-2x text-success"></i>
                <h6 class="mt-2">Total Teachers</h6>
                <h4 class="fw-bold">
                    {{ \App\Models\AllTeacher::count() }}
                </h4>
            </div>
        </div>
    </div>

    <!-- Parents Card -->
    <div class="col-md-4">
        <div class="card shadow-lg border-0 mt-4">
            <div class="card-body text-center">
                <i class="fa-solid fa-users fa-2x text-warning"></i>
                <h6 class="mt-2">Total Parents</h6>
                <h4 class="fw-bold">
                    {{ \App\Models\ParentModel::count() }}
                </h4>
            </div>
        </div>
    </div>
</div>

@endsection

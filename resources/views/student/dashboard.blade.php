@extends('layouts.student')

@section('content')
    <h3 class="mb-4 mt-4">Welcome to Your Dashboard</h3>

    {{-- 🔢 Stats Cards --}}
    <div class="row mb-4 text-center">
        <div class="col-6 col-md-3 mb-3">
            <div class="card shadow-sm p-3 border-0 bg-light">
                <div class="text-primary fs-2"><i class="fa-solid fa-book"></i></div>
                <h6 class="mt-2 mb-0">Subjects</h6>
                <strong class="text-dark fs-4">{{ $subjectsCount }}</strong>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card shadow-sm p-3 border-0 bg-light">
                <div class="text-danger fs-2"><i class="fa-solid fa-clipboard-list"></i></div>
                <h6 class="mt-2 mb-0">Marks</h6>
                <strong class="text-dark fs-4">{{ $marksCount }}</strong>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card shadow-sm p-3 border-0 bg-light">
                <div class="text-success fs-2"><i class="fa-solid fa-person-chalkboard"></i></div>
                <h6 class="mt-2 mb-0">Teachers</h6>
                <strong class="text-dark fs-4">{{ $teachersCount }}</strong>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card shadow-sm p-3 border-0 bg-light">
                <div class="text-info fs-2"><i class="fa-solid fa-calendar-days"></i></div>
                <h6 class="mt-2 mb-0">Exams</h6>
                <strong class="text-dark fs-4">{{ $examSchedules->count() }}</strong>
            </div>
        </div>
    </div>

    {{-- 📅 Today's Classes & Calendar --}}
    <div class="row mb-4">
        {{-- ✅ First: Today's Classes --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0">
                    <h6 class="mb-0"><i class="fa-solid fa-clock"></i> Today's Classes</h6>
                </div>
                <div class="card-body p-2">
                    @if ($todayClasses->isEmpty())
                        <div class="p-3 text-center">No classes today!</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Teacher</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todayClasses as $class)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $class->subject->name }}</td>
                                            <td>{{ $class->teacher->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($class->start_time)->format('h:i A') }} -
                                                {{ \Carbon\Carbon::parse($class->end_time)->format('h:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ✅ Second: Calendar --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0">
                    <h6 class="mb-0"><i class="fa-solid fa-calendar"></i> Calendar</h6>
                </div>
                <div class="card-body p-2">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>



    {{-- 🧪 Exam Schedule --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-0">
            <h6 class="mb-0"><i class="fa-solid fa-pen-to-square"></i> Upcoming Exams</h6>
        </div>
        <div class="card-body p-2">
            @if ($examSchedules->isEmpty())
                <div class="p-3 text-center">No upcoming exams!</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-warning">
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($examSchedules as $exam)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $exam->subject->name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($exam->start_time)->format('h:i A') }} -
                                        {{ \Carbon\Carbon::parse($exam->end_time)->format('h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- 🚀 Quick Shortcuts --}}
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-white border-0">
            <h6 class="mb-0"><i class="fa-solid fa-bolt"></i> Quick Shortcuts</h6>
        </div>
        <div class="card-body d-flex flex-wrap gap-2">
            <a href="{{ route('student.subjects') }}" class="btn btn-outline-primary">My Subjects</a>
            <a href="{{ route('student.exam.schedule') }}" class="btn btn-outline-warning">Exam Schedule</a>
            <a href="{{ route('student.classroutine') }}" class="btn btn-outline-success">Class Routine</a>
        </div>
    </div>
@endsection

{{-- 📅 FullCalendar Script --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/student') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "/fullcalender",
                displayEventTime: false,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");

                        $.ajax({
                            url: SITEURL + "/fullcalenderAjax",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },
                            type: "POST",
                            success: function(data) {
                                toastr.success("Event Created Successfully");
                                $('#calendar').fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true);
                                $('#calendar').fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventClick: function(event) {
                    if (confirm("Do you really want to delete?")) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                toastr.success("Event Deleted Successfully");
                            }
                        });
                    }
                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            toastr.success("Event Updated Successfully");
                        }
                    });
                }
            });
        });
    </script>
@endpush

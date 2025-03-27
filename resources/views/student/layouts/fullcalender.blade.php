@extends('layouts.student')
@section('content')
    <div class="container">
        <h1>Laravel FullCalendar</h1>
        <div id='calendar'></div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                var SITEURL = "{{ url('/student') }}"; // Adjusted for your route group

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
@endsection

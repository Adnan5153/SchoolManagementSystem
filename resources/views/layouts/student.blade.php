<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- 🔗 CSS Libraries --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    {{-- ✅ Toastr for Notifications --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- jQuery - MUST BE FIRST -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Moment.js (dependency of fullCalendar) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- FullCalendar v3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

    <!-- Toastr for notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body class="sb-nav-fixed">

    {{-- 🔝 Navbar --}}
    @include('student.partials.navbar')

    {{-- 🔄 Main Layout --}}
    <div class="d-flex" style="min-height: 100vh; overflow-x: hidden;">
        {{-- 📌 Sidebar --}}
        <aside id="sidebar" class="shadow-lg">
            @include('student.partials.sidebar')
        </aside>

        {{-- 📄 Main Content --}}
        <main class="flex-grow-1 p-4">
            <div class="container-fluid px-4">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- 📜 Bootstrap Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- 📌 Page-specific Scripts --}}
    @stack('scripts')

</body>

</html>

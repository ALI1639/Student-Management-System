@extends('layout')

@section('title', 'Student Dashboard')

@section('content')

    <!-- ==========================================
                                                WELCOME CARD
                                                ========================================== -->

    <div class="card shadow border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h2 class="fw-bold">

                        Welcome,

                        <span class="text-primary">

                            {{ auth()->user()->name }}

                        </span>

                        👋

                    </h2>

                    <p class="text-muted mb-0">

                        Student Dashboard

                    </p>

                </div>

                <div class="col-md-4 text-end">

                    <i class="bi bi-mortarboard-fill text-primary" style="font-size:90px;"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================
                                                PROFILE CARD
                                                ========================================== -->

    <div class="card shadow border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bi bi-person-circle text-success"></i>

                My Profile

            </h5>

        </div>

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-2 text-center">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                        class="rounded-circle shadow" width="100">

                </div>

                <div class="col-md-10">

                    <div class="row">

                        <div class="col-md-6">

                            <strong>Name</strong>

                            <p>{{ auth()->user()->name }}</p>

                        </div>

                        <div class="col-md-6">

                            <strong>Email</strong>

                            <p>{{ auth()->user()->email }}</p>

                        </div>

                        <div class="col-md-6">

                            <strong>Role</strong>

                            <p>{{ auth()->user()->role }}</p>

                        </div>

                        <div class="col-md-6">

                            <strong>Status</strong>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================
                                                SUMMARY CARDS
                                                ========================================== -->

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>{{ $subjects }}</h3>

                    <p>Subjects</p>

                </div>

                <div class="icon">

                    <i class="bi bi-book-fill"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $courses }}</h3>

                    <p>Courses</p>

                </div>

                <div class="icon">

                    <i class="bi bi-journal-bookmark-fill"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>{{ $presentToday }}</h3>

                    <p>Present Today</p>

                </div>

                <div class="icon">

                    <i class="bi bi-calendar-check-fill"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-danger">

                <div class="inner">

                    <h3>{{ $results }}</h3>

                    <p>Results</p>

                </div>

                <div class="icon">

                    <i class="bi bi-award-fill"></i>

                </div>

            </div>

        </div>

    </div>


    <!-- ==========================================================
                                                ATTENDANCE & RESULT CHARTS
                                                ========================================================== -->

    <div class="row  g-4 mt-4">

        <!-- Attendance Chart -->

        <div class="col-lg-8">
            <div class="card shadow border-0">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">

                        <i class="bi bi-bar-chart-line-fill text-primary"></i>

                        Attendance Overview

                    </h5>

                    <span class="badge bg-primary">

                        This Month

                    </span>

                </div>

                <div class="card-body">

                    <canvas id="attendanceChart" height="100"></canvas>

                </div>

            </div>

        </div>

        <!-- Attendance Summary -->

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-pie-chart-fill text-success"></i>

                        Attendance Summary

                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="attendancePieChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                                RESULT PROGRESS
                                                ========================================================== -->

    <div class="row g-4  mt-4">

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-award-fill text-warning"></i>

                        Academic Performance

                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <label class="fw-bold">

                            Attendance

                        </label>

                        <div class="progress">

                            <div class="progress-bar bg-success" style="width:90%">

                                90%

                            </div>

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="fw-bold">

                            Assignment

                        </label>

                        <div class="progress">

                            <div class="progress-bar bg-primary" style="width:80%">

                                80%

                            </div>

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="fw-bold">

                            Quiz

                        </label>

                        <div class="progress">

                            <div class="progress-bar bg-warning" style="width:75%">

                                75%

                            </div>

                        </div>

                    </div>

                    <div>

                        <label class="fw-bold">

                            Final Result

                        </label>

                        <div class="progress">

                            <div class="progress-bar bg-danger" style="width:85%">

                                85%

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Quick Statistics -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-graph-up-arrow text-success"></i>

                        Performance Statistics

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row text-center">

                        <div class="col-6 mb-4">

                            <h2 class="text-success">

                                {{ $presentToday }}

                            </h2>

                            <small class="text-muted">

                                Present Today

                            </small>

                        </div>

                        <div class="col-6 mb-4">

                            <h2 class="text-danger">

                                {{ $results }}

                            </h2>

                            <small class="text-muted">

                                Results

                            </small>

                        </div>

                        <div class="col-6">

                            <h2 class="text-primary">

                                {{ $subjects }}

                            </h2>

                            <small class="text-muted">

                                Subjects

                            </small>

                        </div>

                        <div class="col-6">

                            <h2 class="text-warning">

                                {{ $courses }}

                            </h2>

                            <small class="text-muted">

                                Courses

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                            RECENT RESULTS & RECENT ATTENDANCE
                                            ========================================================== -->

    <div class="row g-4 mt-4">

        <!-- Recent Results -->

        <div class="col-lg-7">

            <div class="card shadow border-0">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">

                        <i class="bi bi-award-fill text-success"></i>

                        Recent Results

                    </h5>

                    <a href="{{ route('results.index') }}" class="btn btn-success btn-sm">

                        View All

                    </a>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>Subject</th>

                                <th>Marks</th>

                                <th>Grade</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentResults as $result)
                                <tr>

                                    <td>

                                        {{ $result->subject->name ?? '-' }}

                                    </td>

                                    <td>

                                        {{ $result->obtained_marks }}

                                        /

                                        {{ $result->total_marks }}

                                    </td>

                                    <td>

                                        <span class="badge bg-primary">

                                            {{ $result->grade }}

                                        </span>

                                    </td>

                                    <td>

                                        @if ($result->status == 'Pass')
                                            <span class="badge bg-success">

                                                Pass

                                            </span>
                                        @else
                                            <span class="badge bg-danger">

                                                Fail

                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center">

                                        No Result Found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Recent Attendance -->

        <div class="col-lg-5">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-calendar-check-fill text-primary"></i>

                        Recent Attendance

                    </h5>

                </div>

                <div class="card-body">

                    @forelse($recentAttendance as $attendance)
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div>

                                <strong>

                                    {{ $attendance->attendance_date }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    {{ $attendance->subject->name ?? 'Subject' }}

                                </small>

                            </div>

                            @if ($attendance->status == 'P')
                                <span class="badge bg-success">Present</span>
                            @elseif($attendance->status == 'A')
                                <span class="badge bg-danger">Absent</span>
                            @else
                                <span class="badge bg-warning text-dark">Leave</span>
                            @endif

                        </div>

                        <hr>

                    @empty

                        <p class="text-center text-muted">

                            No Attendance Found

                        </p>
                    @endforelse

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                            MY SUBJECTS
                                            ========================================================== -->

    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-white d-flex justify-content-between">

            <h5 class="mb-0">

                <i class="bi bi-book-half text-warning"></i>

                My Subjects

            </h5>

            <a href="{{ route('subjects.index') }}" class="btn btn-warning btn-sm text-white">

                View All

            </a>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Subject</th>

                        <th>Code</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($subjectList as $subject)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $subject->name }}</td>

                            <td>{{ $subject->code }}</td>

                            <td>

                                <span class="badge bg-success">

                                    Active

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center">

                                No Subjects Found

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- ==========================================================
                                            ANNOUNCEMENTS | UPCOMING CLASSES | NOTIFICATIONS
                                            ========================================================== -->

    <div class="row g-4 mt-4">

        <!-- Announcements -->

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-megaphone-fill text-danger"></i>

                        Latest Announcements

                    </h5>

                </div>

                <div class="card-body">

                    <div class="alert alert-primary py-2">

                        📢 Mid Term Exams will start from <strong>10 August</strong>.

                    </div>

                    <div class="alert alert-success py-2">

                        🎓 New Semester Registration is Open.

                    </div>

                    <div class="alert alert-warning py-2">

                        📚 Assignment Submission Deadline: Friday.

                    </div>

                    <div class="alert alert-info py-2 mb-0">

                        📝 Quiz Schedule has been Updated.

                    </div>

                </div>

            </div>

        </div>

        <!-- Upcoming Classes -->

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-calendar-event-fill text-primary"></i>

                        Today's Classes

                    </h5>

                </div>

                <div class="card-body">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item d-flex justify-content-between">

                            Web Engineering

                            <span class="badge bg-primary">

                                09:00 AM

                            </span>

                        </li>

                        <li class="list-group-item d-flex justify-content-between">

                            Database Systems

                            <span class="badge bg-success">

                                11:00 AM

                            </span>

                        </li>

                        <li class="list-group-item d-flex justify-content-between">

                            Software Design

                            <span class="badge bg-warning text-dark">

                                01:00 PM

                            </span>

                        </li>

                        <li class="list-group-item d-flex justify-content-between">

                            OOP

                            <span class="badge bg-danger">

                                03:00 PM

                            </span>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <!-- Notifications -->

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-bell-fill text-warning"></i>

                        Notifications

                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex mb-3">

                        <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>

                        <div>

                            <strong>Attendance Marked</strong>

                            <br>

                            <small class="text-muted">

                                Your attendance has been updated.

                            </small>

                        </div>

                    </div>

                    <div class="d-flex mb-3">

                        <i class="bi bi-award-fill text-primary fs-4 me-3"></i>

                        <div>

                            <strong>Result Published</strong>

                            <br>

                            <small class="text-muted">

                                Check your latest result.

                            </small>

                        </div>

                    </div>

                    <div class="d-flex">

                        <i class="bi bi-book-fill text-danger fs-4 me-3"></i>

                        <div>

                            <strong>New Subject Added</strong>

                            <br>

                            <small class="text-muted">

                                A new subject has been assigned.

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                            QUICK LINKS
                                            ========================================================== -->

    <div class="card shadow border-0 mt-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bi bi-lightning-fill text-warning"></i>

                Quick Links

            </h5>

        </div>

        <div class="card-body">

            <div class="row text-center">

                <div class="col-lg-3 col-md-6 mb-3">

                    <a href="{{ route('subjects.index') }}" class="btn btn-outline-primary w-100 py-3">

                        <i class="bi bi-book-fill fs-3"></i>

                        <br>

                        Subjects

                    </a>

                </div>

                <div class="col-lg-3 col-md-6 mb-3">

                    <a href="{{ route('attendances.index') }}" class="btn btn-outline-success w-100 py-3">

                        <i class="bi bi-calendar-check-fill fs-3"></i>

                        <br>

                        Attendance

                    </a>

                </div>

                <div class="col-lg-3 col-md-6 mb-3">

                    <a href="{{ route('results.index') }}" class="btn btn-outline-warning w-100 py-3">

                        <i class="bi bi-award-fill fs-3"></i>

                        <br>

                        Results

                    </a>

                </div>

                <div class="col-lg-3 col-md-6 mb-3">

                    <a href="{{ route('profile') }}" class="btn btn-outline-danger w-100 py-3">

                        <i class="bi bi-person-circle fs-3"></i>

                        <br>

                        Profile

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                            ACADEMIC PROGRESS | GOALS | CALENDAR
                                            ========================================================== -->

    <div class="row g-4 mt-4">

        <!-- Academic Progress -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-graph-up-arrow text-success"></i>

                        Academic Progress

                    </h5>

                </div>

                <div class="card-body">

                    <label class="fw-bold">Attendance</label>

                    <div class="progress mb-3">

                        <div class="progress-bar bg-success" style="width:90%">

                            90%

                        </div>

                    </div>

                    <label class="fw-bold">Assignments</label>

                    <div class="progress mb-3">

                        <div class="progress-bar bg-primary" style="width:82%">

                            82%

                        </div>

                    </div>

                    <label class="fw-bold">Quiz Performance</label>

                    <div class="progress mb-3">

                        <div class="progress-bar bg-warning" style="width:76%">

                            76%

                        </div>

                    </div>

                    <label class="fw-bold">Semester Progress</label>

                    <div class="progress">

                        <div class="progress-bar bg-danger" style="width:65%">

                            65%

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Goals -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-bullseye text-danger"></i>

                        Academic Goals

                    </h5>

                </div>

                <div class="card-body">

                    <div class="form-check mb-3">

                        <input class="form-check-input" checked disabled type="checkbox">

                        <label class="form-check-label">

                            Maintain 90% Attendance

                        </label>

                    </div>

                    <div class="form-check mb-3">

                        <input class="form-check-input" checked disabled type="checkbox">

                        <label class="form-check-label">

                            Submit All Assignments

                        </label>

                    </div>

                    <div class="form-check mb-3">

                        <input class="form-check-input" disabled type="checkbox">

                        <label class="form-check-label">

                            Score Above 85%

                        </label>

                    </div>

                    <div class="form-check">

                        <input class="form-check-input" disabled type="checkbox">

                        <label class="form-check-label">

                            Complete Semester Project

                        </label>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                            CALENDAR | MOTIVATION
                                            ========================================================== -->

    <div class="row g-4 mt-4">

        <!-- Academic Calendar -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-calendar3 text-primary"></i>

                        Academic Calendar

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-hover">

                        <tbody>

                            <tr>

                                <td>📚 Mid Term Exams</td>

                                <td class="text-end">

                                    10 Aug

                                </td>

                            </tr>

                            <tr>

                                <td>📝 Final Project</td>

                                <td class="text-end">

                                    25 Aug

                                </td>

                            </tr>

                            <tr>

                                <td>🎓 Semester Exams</td>

                                <td class="text-end">

                                    05 Sep

                                </td>

                            </tr>

                            <tr>

                                <td>🏆 Result Announcement</td>

                                <td class="text-end">

                                    20 Sep

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Motivation -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-stars text-warning"></i>

                        Motivation

                    </h5>

                </div>

                <div class="card-body text-center">

                    <i class="bi bi-mortarboard-fill text-primary" style="font-size:80px;"></i>

                    <h4 class="mt-3">

                        Keep Learning 🚀

                    </h4>

                    <p class="text-muted">

                        Success comes from consistency.
                        Study every day and improve yourself.

                    </p>

                    <button class="btn btn-primary">

                        Start Learning

                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                            FOOTER STATS
                                            ========================================================== -->

    <div class="row mt-4">

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card text-center border-0 shadow">

                <div class="card-body">

                    <i class="bi bi-book-fill text-primary fs-1"></i>

                    <h4 class="mt-2">

                        {{ $subjects }}

                    </h4>

                    <small class="text-muted">

                        Subjects

                    </small>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card text-center border-0 shadow">

                <div class="card-body">

                    <i class="bi bi-journal-bookmark-fill text-success fs-1"></i>

                    <h4 class="mt-2">

                        {{ $courses }}

                    </h4>

                    <small class="text-muted">

                        Courses

                    </small>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card text-center border-0 shadow">

                <div class="card-body">

                    <i class="bi bi-calendar-check-fill text-warning fs-1"></i>

                    <h4 class="mt-2">

                        {{ $presentToday }}

                    </h4>

                    <small class="text-muted">

                        Present Today

                    </small>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card text-center border-0 shadow">

                <div class="card-body">

                    <i class="bi bi-award-fill text-danger fs-1"></i>

                    <h4 class="mt-2">

                        {{ $results }}

                    </h4>

                    <small class="text-muted">

                        Results

                    </small>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')
        <script>
            new Chart(document.getElementById('attendanceChart'), {

                type: 'bar',

                data: {

                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                    datasets: [{

                        label: 'Present Attendance',

                        data: @json($attendanceChart),

                        backgroundColor: '#0d6efd',

                        borderRadius: 8

                    }]

                },

                options: {

                    responsive: true,

                    plugins: {

                        legend: {
                            display: false
                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {
                                stepSize: 1
                            }

                        }

                    }

                }

            });



            new Chart(document.getElementById('attendancePieChart'), {

                type: 'doughnut',

                data: {

                    labels: ['Present', 'Absent'],

                    datasets: [{

                        data: [
                            {{ $present }},
                            {{ $absent }}
                        ],

                        backgroundColor: [
                            '#198754',
                            '#dc3545'
                        ]

                    }]

                }

            });
        </script>
    @endpush


@endsection

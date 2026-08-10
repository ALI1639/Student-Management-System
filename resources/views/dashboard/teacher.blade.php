@extends('layout')

@section('title', 'Teacher Dashboard')

@section('content')

    <!-- ==========================================
                                                                                                                                    WELCOME CARD
                                                                                                                                    ========================================== -->

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h2 class="fw-bold">

                        Welcome,

                        <span class="text-success">

                            {{ auth()->user()->name }}

                        </span>

                        👋

                    </h2>

                    <p class="text-muted">

                        Teacher Dashboard

                    </p>

                </div>

                <div class="col-md-4 text-end">

                    <i class="bi bi-person-workspace text-success" style="font-size:90px;"></i>

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

                    <h3>{{ $students }}</h3>

                    <p>My Students</p>

                </div>

                <div class="icon">

                    <i class="bi bi-people-fill"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-success">

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

                    <p>Total Results</p>

                </div>

                <div class="icon">

                    <i class="bi bi-award-fill"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================
                                                                                                                                    QUICK ACTIONS
                                                                                                                                    ========================================== -->

    <div class="card shadow border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bi bi-lightning-fill text-warning"></i>

                Quick Actions

            </h5>

        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-3">

                    <a href="{{ route('attendances.create') }}" class="btn btn-success w-100">

                        Take Attendance

                    </a>

                </div>

                <div class="col-md-3">

                    <a href="{{ route('results.create') }}" class="btn btn-primary w-100">

                        Add Result

                    </a>

                </div>

                <div class="col-md-3">

                    <a href="{{ route('students.index') }}" class="btn btn-warning w-100 text-white">

                        View Students

                    </a>

                </div>

                <div class="col-md-3">

                    <a href="{{ route('subjects.index') }}" class="btn btn-danger w-100">

                        View Subjects

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                                                                                                                    TEACHER CHARTS
                                                                                                                                    ========================================================== -->

    <div class="row g-4 mt-4">

        <!-- Attendance Overview -->

        <div class="col-lg-8">

            <div class="card shadow border-0 h-100">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-bar-chart-line-fill text-success me-2"></i>
                        Attendance Overview
                    </h5>

                </div>

                <div class="card-body">

                    <div class="teacher-chart-container">

                        <canvas id="teacherAttendanceChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

        <!-- Today's Summary -->

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        <i class="bi bi-pie-chart-fill text-primary"></i>
                        Today's Summary
                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="teacherPieChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                                                                                                                    RECENT STUDENTS & RESULTS
                                                                                                                                    ========================================================== -->

    <div class="row g-4 mt-4">

        <!-- Recent Students -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white d-flex justify-content-between">

                    <h5 class="mb-0">
                        <i class="bi bi-people-fill text-primary"></i>
                        Recent Students
                    </h5>

                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-primary">
                        View All
                    </a>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Name</th>

                                <th>Department</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($recentStudents as $student)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $student->name }}</td>

                                    <td>{{ $student->department->name ?? '-' }}</td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Recent Results -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white d-flex justify-content-between">

                    <h5 class="mb-0">
                        <i class="bi bi-award-fill text-warning"></i>
                        Recent Results
                    </h5>

                    <a href="{{ route('results.index') }}" class="btn btn-sm btn-warning text-white">
                        View All
                    </a>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th>Student</th>

                                <th>Grade</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($recentResults as $result)
                                <tr>

                                    <td>{{ $result->student->name }}</td>

                                    <td>{{ $result->grade }}</td>

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
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                                                                                                                TOP STUDENTS | UPCOMING CLASSES | NOTIFICATIONS
                                                                                                                                ========================================================== -->

    <div class="row g-4 mt-4">

        <!-- Top Students -->

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        <i class="bi bi-trophy-fill text-warning"></i>
                        Top Students
                    </h5>

                </div>

                <div class="card-body">

                    @forelse($topStudents as $student)
                        <div class="d-flex align-items-center mb-3">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}"
                                class="rounded-circle me-3" width="45" height="45">

                            <div class="flex-grow-1">

                                <strong>{{ $student->name }}</strong>

                                <br>

                                <small class="text-muted">

                                    {{ $student->department->name ?? '-' }}

                                </small>

                            </div>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </div>

                    @empty

                        <p class="text-center text-muted">

                            No Students Found

                        </p>
                    @endforelse

                </div>

            </div>

        </div>

        <!-- Upcoming Classes -->

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-calendar-event-fill text-primary"></i>

                        Upcoming Classes

                    </h5>

                </div>

                <div class="card-body">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">

                            OOP (BSSE)

                            <span class="badge bg-primary float-end">

                                09:00 AM

                            </span>

                        </li>

                        <li class="list-group-item">

                            Database Systems

                            <span class="badge bg-success float-end">

                                11:00 AM

                            </span>

                        </li>

                        <li class="list-group-item">

                            Web Engineering

                            <span class="badge bg-warning text-dark float-end">

                                01:00 PM

                            </span>

                        </li>

                        <li class="list-group-item">

                            Software Design

                            <span class="badge bg-danger float-end">

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

                        <i class="bi bi-bell-fill text-danger"></i>

                        Notifications

                    </h5>

                </div>

                <div class="card-body">

                    <div class="alert alert-success py-2">

                        ✅ Attendance Submitted

                    </div>

                    <div class="alert alert-warning py-2">

                        📝 Check Pending Results

                    </div>

                    <div class="alert alert-info py-2">

                        📚 New Subject Assigned

                    </div>

                    <div class="alert alert-danger py-2 mb-0">

                        📢 Staff Meeting Tomorrow

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================================
                                                                                                                                QUICK STATS
                                                                                                                                ========================================================== -->

    <div class="row g-4 mt-4">

        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow">

                <div class="card-body text-center">

                    <i class="bi bi-people-fill fs-1 text-primary"></i>

                    <h3 class="mt-3">

                        {{ $students }}

                    </h3>

                    <p class="text-muted mb-0">

                        Students

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow">

                <div class="card-body text-center">

                    <i class="bi bi-book-fill fs-1 text-success"></i>

                    <h3 class="mt-3">

                        {{ $subjects }}

                    </h3>

                    <p class="text-muted mb-0">

                        Subjects

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow">

                <div class="card-body text-center">

                    <i class="bi bi-calendar-check-fill fs-1 text-warning"></i>

                    <h3 class="mt-3">

                        {{ $presentToday }}

                    </h3>

                    <p class="text-muted mb-0">

                        Present Today

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card border-0 shadow">

                <div class="card-body text-center">

                    <i class="bi bi-award-fill fs-1 text-danger"></i>

                    <h3 class="mt-3">

                        {{ $results }}

                    </h3>

                    <p class="text-muted mb-0">

                        Results

                    </p>

                </div>

            </div>

        </div>

    </div>


    @push('scripts')
        <script>
            new Chart(
                document.getElementById('teacherAttendanceChart'), {
                    type: 'bar',

                    data: {
                        labels: @json($teacherSubjectAttendance->pluck('subject')),

                        datasets: [{
                            label: 'Attendance %',

                            data: @json($teacherSubjectAttendance->pluck('percentage')),

                            backgroundColor: '#198754',

                            borderRadius: 8
                        }]
                    },

                    options: {
                        responsive: true,

                        maintainAspectRatio: false,

                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,

                                ticks: {
                                    callback: function(value) {
                                        return value + '%';
                                    }
                                }
                            }
                        },

                        plugins: {
                            legend: {
                                display: false
                            },

                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.raw +
                                            '% Attendance';
                                    }
                                }
                            }
                        }
                    }
                }
            );



            new Chart(
                document.getElementById('teacherPieChart'), {
                    type: 'doughnut',

                    data: {
                        labels: [
                            'Present',
                            'Absent'
                        ],

                        datasets: [{
                            data: [
                                {{ $teacherTotalPresent }},
                                {{ $teacherTotalAbsent }}
                            ],

                            backgroundColor: [
                                '#198754',
                                '#dc3545'
                            ],

                            borderWidth: 0
                        }]
                    },

                    options: {
                        responsive: true,

                        maintainAspectRatio: false,

                        cutout: '70%',

                        plugins: {
                            legend: {
                                position: 'bottom'
                            },

                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.label +
                                            ': ' +
                                            context.raw;
                                    }
                                }
                            }
                        }
                    }
                }
            );
        </script>
    @endpush

@endsection

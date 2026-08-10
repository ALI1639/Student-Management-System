@extends('layout')

@section('title', 'Admin Dashboard')

@section('content')

    {{-- ----------- Welcome Head --------------- --}}

    <div class="card  border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">

                <div class="col-md-8">

                    <h2 class="fw-bold mb-2">
                        Welcome Back,
                        <span class="text-primary">
                            {{ auth()->user()->name }}
                        </span>
                        👋
                    </h2>

                    <p class="text-muted mb-3">
                        Student Management System Dashboard
                    </p>

                    <div class="d-flex gap-2">

                        <a href="{{ route('students.create') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus-fill"></i>
                            Add Student
                        </a>

                        <a href="{{ route('teachers.create') }}" class="btn btn-success">
                            <i class="bi bi-person-workspace"></i>
                            Add Teacher
                        </a>

                    </div>

                </div>

                <div class="col-md-4 mt-3 text-end">

                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="170">

                </div>

            </div>

        </div>
    </div>



    <div class="row">

        <!-- Students -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $students }}</h3>
                    <p>Total Students</p>
                </div>

                <div class="icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <a href="{{ route('students.index') }}" class="small-box-footer">
                    More info
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </a>

            </div>

        </div>

        <!-- Teachers -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $teachers }}</h3>
                    <p>Total Teachers</p>
                </div>

                <div class="icon">
                    <i class="bi bi-person-workspace"></i>
                </div>

                <a href="{{ route('teachers.index') }}" class="small-box-footer">
                    More info
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </a>

            </div>

        </div>

        <!-- Departments -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>{{ $departments }}</h3>

                    <p>Departments</p>

                </div>

                <div class="icon">

                    <i class="bi bi-building-fill"></i>

                </div>

                <a href="{{ route('departments.index') }}" class="small-box-footer">

                    More info

                    <i class="bi bi-arrow-right-circle-fill"></i>

                </a>

            </div>

        </div>

        <!-- Courses -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="small-box bg-danger">

                <div class="inner">

                    <h3>{{ $courses }}</h3>

                    <p>Total Courses</p>

                </div>

                <div class="icon">

                    <i class="bi bi-book-fill"></i>

                </div>

                <a href="{{ route('courses.index') }}" class="small-box-footer">

                    More info

                    <i class="bi bi-arrow-right-circle-fill"></i>

                </a>

            </div>

        </div>

    </div>

    {{-- ----------- INFO BOXES -------------- --}}

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card">

                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary rounded-circle p-3 me-3">
                        <i class="bi bi-journal-bookmark-fill text-white fs-3"></i>
                    </div>
                    <div>

                        <h5 class="mb-0">{{ $subjects }}</h5>

                        <small class="text-muted">
                            Subjects
                        </small>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card">

                <div class="card-body d-flex align-items-center">

                    <div class="bg-success rounded-circle p-3 me-3">

                        <i class="bi bi-calendar-check-fill text-white fs-3"></i>

                    </div>

                    <div>

                        <h5 class="mb-0">{{ $attendance }}</h5>

                        <small class="text-muted">
                            Attendance
                        </small>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card">

                <div class="card-body d-flex align-items-center">

                    <div class="bg-warning rounded-circle p-3 me-3">

                        <i class="bi bi-award-fill text-white fs-3"></i>

                    </div>

                    <div>

                        <h5 class="mb-0">{{ $results }}</h5>

                        <small class="text-muted">
                            Results
                        </small>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card">

                <div class="card-body d-flex align-items-center">

                    <div class="bg-danger rounded-circle p-3 me-3">

                        <i class="bi bi-bar-chart-fill text-white fs-3"></i>

                    </div>

                    <div>

                        <h5 class="mb-0">

                            {{ $students + $teachers }}

                        </h5>

                        <small class="text-muted">

                            Total Users

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ----------------- CHARTS SECTION ---------------------- --}}

    <div class="row g-4 mt-2">

        <div class="col-lg-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-bar-chart-line-fill text-primary"></i>
                        System Overview
                    </h5>

                    <span class="badge bg-primary">
                        Statistics
                    </span>
                </div>

                <div class="card-body">
                    <canvas id="systemChart" height="110"></canvas>
                </div>
            </div>
        </div>

        <!-- Active / Inactive Students -->

        <div class="col-lg-4">
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-pie-chart-fill text-success"></i>
                        Student Status
                    </h5>
                </div>

                <div class="card-body">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>


    {{-- --------------- LATEST TABLES -------------------- --}}

    <div class="row g-4 mt-4">

        <!-- Latest Students -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white d-flex justify-content-between">

                    <h5 class="mb-0">

                        <i class="bi bi-people-fill text-primary"></i>

                        Latest Students

                    </h5>

                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-primary">

                        View All

                    </a>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Name</th>

                                <th>Department</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentStudents as $student)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $student->name }}</td>

                                    <td>{{ $student->department->name ?? '-' }}</td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="text-center">

                                        No Student Found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Latest Teachers -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white d-flex justify-content-between">

                    <h5 class="mb-0">

                        <i class="bi bi-person-workspace text-success"></i>

                        Latest Teachers

                    </h5>

                    <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-success">

                        View All

                    </a>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Name</th>

                                <th>Department</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentTeachers as $teacher)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $teacher->name }}</td>

                                    <td>{{ $teacher->department->name ?? '-' }}</td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="text-center">

                                        No Teacher Found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- ------------RESULTS & ATTENDANCE ------------------ --}}

    <div class="row g-4 mt-4">

        <!-- Latest Results -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-award-fill text-warning"></i>

                        Latest Results

                    </h5>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th>Student</th>

                                <th>Grade</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentResults as $result)
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

                            @empty

                                <tr>

                                    <td colspan="3" class="text-center">

                                        No Results

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Attendance -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-calendar-check-fill text-success"></i>

                        Recent Attendance

                    </h5>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th>Student</th>

                                <th>Date</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentAttendance as $attendance)
                                <tr>

                                    <td>{{ $attendance->student->name }}</td>

                                    <td>{{ $attendance->attendance_date->format('d-m-Y') }}</td>

                                    <td>
                                        @if ($attendance->status == 'P')
                                            <span class="badge bg-success">Present</span>
                                        @elseif($attendance->status == 'A')
                                            <span class="badge bg-danger">Absent</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Leave</span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="text-center">

                                        No Attendance

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- ------------------ Qick Action -------------------- --}}

    <div class="row mt-5 g-3">

        <!-- Add Student -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('students.create') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 quick-card text-center">
                    <div class="card-body">
                        <div class="quick-icon bg-primary text-white mx-auto mb-3">
                            <i class="bi bi-person-plus-fill fs-3"></i>
                        </div>

                        <h6 class="fw-bold text-dark mb-1">
                            Add Student
                        </h6>

                        <small class="text-muted">
                            Register a new student
                        </small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Add Teacher -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('teachers.create') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 quick-card text-center">
                    <div class="card-body">
                        <div class="quick-icon bg-success text-white mx-auto mb-3">
                            <i class="bi bi-person-workspace fs-3"></i>
                        </div>

                        <h6 class="fw-bold text-dark mb-1">
                            Add Teacher
                        </h6>

                        <small class="text-muted">
                            Register a new teacher
                        </small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Add Result -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('results.create') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 quick-card text-center">
                    <div class="card-body">
                        <div class="quick-icon bg-warning text-white mx-auto mb-3">
                            <i class="bi bi-award-fill fs-3"></i>
                        </div>

                        <h6 class="fw-bold text-dark mb-1">
                            Add Result
                        </h6>

                        <small class="text-muted">
                            Publish student result
                        </small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Take Attendance -->
        <div class="col-lg-3 col-md-6">
            <a href="{{ route('attendances.create') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100 quick-card text-center">
                    <div class="card-body">
                        <div class="quick-icon bg-danger text-white mx-auto mb-3">
                            <i class="bi bi-calendar-check-fill fs-3"></i>
                        </div>

                        <h6 class="fw-bold text-dark mb-1">
                            Take Attendance
                        </h6>

                        <small class="text-muted">
                            Mark student attendance
                        </small>
                    </div>
                </div>
            </a>
        </div>

    </div>

    {{-- ==================== Activity TimeLine =========================== --}}

    <div class="row g-4 mt-4">

        {{-- Recent Activity --}}
        @if (auth()->user()->role == 'Admin')

            <div class="col-lg-8">

                <div class="card shadow border-0">

                    <div class="card-header bg-white d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">
                            <i class="fas fa-history text-primary me-2"></i>
                            Recent Activities
                        </h5>

                        <a href="{{ route('activities.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye me-1"></i>view
                        </a>

                    </div>

                    <div class="list-group list-group-flush">

                        @forelse($recentActivities as $activity)
                            <div class="list-group-item border-0 border-bottom">

                                <div class="d-flex align-items-start">

                                    {{-- Icon --}}

                                    @if ($activity->action == 'Created')
                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3"
                                            style="width:45px;height:45px;">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    @elseif($activity->action == 'Updated')
                                        <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center me-3"
                                            style="width:45px;height:45px;">

                                            <i class="fas fa-edit"></i>

                                        </div>
                                    @elseif($activity->action == 'Deleted')
                                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center me-3"
                                            style="width:45px;height:45px;">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    @elseif($activity->action == 'Submitted')
                                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center me-3"
                                            style="width:45px;height:45px;">
                                            <i class="fas fa-paper-plane"></i>
                                        </div>
                                    @elseif($activity->action == 'Published')
                                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center me-3"
                                            style="width:45px;height:45px;">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3"
                                            style="width:45px;height:45px;">

                                            <i class="fas fa-history"></i>

                                        </div>
                                    @endif

                                    {{-- Content --}}

                                    <div class="grow">

                                        <div class="fw-bold">

                                            {{ $activity->user->name ?? 'System' }}

                                            <span class="badge bg-light text-dark ms-2">

                                                {{ $activity->module }}

                                            </span>

                                        </div>

                                        <div class="text-muted small">

                                            {{ $activity->description }}

                                        </div>

                                        <small class="text-secondary">

                                            <i class="far fa-clock me-1"></i>

                                            {{ $activity->created_at->diffForHumans() }}

                                        </small>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="text-center py-5">

                                <i class="fas fa-history fa-3x text-muted mb-3"></i>

                                <h6>No Recent Activities</h6>

                            </div>
                        @endforelse

                    </div>

                </div>

            </div>

        @endif

        {{-- Notifications --}}

        <div class="col-lg-4">

            <div class="card shadow border-0 h-100">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        <i class="fas fa-bell text-warning me-2"></i>
                        Recent Notifications
                    </h5>

                    @if ($unreadNotifications > 0)
                        <span class="badge bg-danger">
                            {{ $unreadNotifications }} New
                        </span>
                    @endif

                </div>


                <div class="card-body p-0">

                    @forelse($navbarNotifications as $notification)
                        <a href="{{ route('notifications.read', $notification->id) }}"
                            class="d-flex align-items-start px-3 py-3 text-decoration-none border-bottom notification-item">

                            {{-- ICON --}}
                            <div class="me-3">

                                <div class="rounded-circle bg-{{ $notification->color }}
                                    d-flex justify-content-center align-items-center"
                                    style="width:45px; height:45px;">

                                    <i class="fas {{ $notification->icon }} text-white" style="font-size:18px;">
                                    </i>

                                </div>

                            </div>


                            {{-- NOTIFICATION CONTENT --}}
                            <div class="flex-grow-1">

                                <div class="fw-semibold text-dark">

                                    {{ $notification->title }}

                                    @if (!$notification->is_read)
                                        <span class="badge bg-danger ms-1">
                                            New
                                        </span>
                                    @endif

                                </div>


                                <small class="text-muted d-block">

                                    {{ $notification->message }}

                                </small>


                                <small class="text-secondary">

                                    {{ $notification->created_at->diffForHumans() }}

                                </small>

                            </div>

                        </a>


                    @empty

                        <div class="text-center py-5">

                            <i class="fas fa-bell-slash fa-3x text-secondary mb-3"></i>

                            <p class="text-muted mb-0">
                                No Notifications Found
                            </p>

                        </div>
                    @endforelse

                </div>


                <div class="card-footer bg-white text-center">

                    <a href="{{ route('notifications.index') }}" class="fw-bold text-decoration-none">

                        View All Notifications

                    </a>

                </div>

            </div>

        </div>


    </div>


    {{-- ----------------TOP STUDENTS / TOP TEACHERS------------------ --}}

    <div class="row g-4 mt-4">

        <!-- Top Students -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white d-flex justify-content-between">

                    <h5 class="mb-0">

                        <i class="bi bi-trophy-fill text-warning"></i>

                        Top Students

                    </h5>

                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-primary">

                        View All

                    </a>

                </div>

                <div class="card-body">

                    @forelse($topStudents as $student)
                        <div class="d-flex align-items-center mb-3">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}"
                                class="rounded-circle me-3" width="50" height="50">

                            <div class="flex-grow-1">

                                <strong>

                                    {{ $student->name }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    Roll #

                                    {{ $student->roll_number }}

                                </small>

                            </div>

                            <span class="badge bg-success">

                                Active

                            </span>

                        </div>

                    @empty

                        <p class="text-center text-muted">

                            No Student Found

                        </p>
                    @endforelse

                </div>

            </div>

        </div>

        <!-- Top Teachers -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white d-flex justify-content-between">

                    <h5 class="mb-0">

                        <i class="bi bi-person-badge-fill text-success"></i>

                        Top Teachers

                    </h5>

                    <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-success">

                        View All

                    </a>

                </div>

                <div class="card-body">

                    @forelse($topTeachers as $teacher)
                        <div class="d-flex align-items-center mb-3">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}"
                                class="rounded-circle me-3" width="50" height="50">

                            <div class="flex-grow-1">

                                <strong>

                                    {{ $teacher->name }}

                                </strong>

                                <br>

                                <small class="text-muted">

                                    {{ $teacher->department->name ?? '-' }}

                                </small>

                            </div>

                            <span class="badge bg-primary">

                                Faculty

                            </span>

                        </div>

                    @empty

                        <p class="text-center text-muted">

                            No Teacher Found

                        </p>
                    @endforelse

                </div>

            </div>

        </div>

    </div>

    {{-- ----------------UPCOMING EVENTS & SYSTEM STATUS ---------------------- --}}

    <div class="row g-4 mt-4">

        <!-- Upcoming Events -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-calendar-event-fill text-danger"></i>

                        Upcoming Events

                    </h5>

                </div>

                <div class="card-body">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">

                            📚 Mid Term Exams

                            <span class="float-end badge bg-primary">

                                10 Aug

                            </span>

                        </li>

                        <li class="list-group-item">

                            📝 Result Announcement

                            <span class="float-end badge bg-success">

                                15 Aug

                            </span>

                        </li>

                        <li class="list-group-item">

                            🎓 New Admissions

                            <span class="float-end badge bg-warning">

                                20 Aug

                            </span>

                        </li>

                        <li class="list-group-item">

                            🏫 Semester Starts

                            <span class="float-end badge bg-danger">

                                01 Sep

                            </span>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <!-- System Health -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-cpu-fill text-primary"></i>

                        System Health

                    </h5>

                </div>

                <div class="card-body">

                    <label class="fw-bold">

                        Database

                    </label>

                    <div class="progress mb-3">

                        <div class="progress-bar bg-success" style="width:95%">

                            95%

                        </div>

                    </div>

                    <label class="fw-bold">

                        Server

                    </label>

                    <div class="progress mb-3">

                        <div class="progress-bar bg-primary" style="width:88%">

                            88%

                        </div>

                    </div>

                    <label class="fw-bold">

                        Storage

                    </label>

                    <div class="progress">

                        <div class="progress-bar bg-warning" style="width:72%">

                            72%

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ---------- Result Statistics ------------ --}}

    <div class="row g-4 mt-4">

        <!-- Result Statistics -->

        <div class="col-lg-6">
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up-arrow text-danger"></i>
                        Result Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="resultChart" height="120"></canvas>
                </div>
            </div>

        </div>

        <!-- Progress Card -->

        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-activity text-warning"></i>

                        System Progress

                    </h5>

                </div>

                <div class="card-body">

                    <label class="fw-semibold">Students</label>

                    <div class="progress mb-3">

                        <div class="progress-bar bg-primary" style="width:90%">
                            90%
                        </div>

                    </div>

                    <label class="fw-semibold">Teachers</label>

                    <div class="progress mb-3">

                        <div class="progress-bar bg-success" style="width:75%">
                            75%
                        </div>

                    </div>

                    <label class="fw-semibold">Courses</label>

                    <div class="progress mb-3">

                        <div class="progress-bar bg-warning" style="width:65%">
                            65%
                        </div>

                    </div>

                    <label class="fw-semibold">Results</label>

                    <div class="progress">

                        <div class="progress-bar bg-danger" style="width:80%">
                            80%
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                //==========================
                // System Overview
                //==========================

                new Chart(document.getElementById('systemChart'), {

                    type: 'bar',

                    data: {

                        labels: [
                            'Students',
                            'Teachers',
                            'Departments',
                            'Courses'
                        ],

                        datasets: [{

                            label: 'Total Records',

                            data: [
                                {{ $students }},
                                {{ $teachers }},
                                {{ $departments }},
                                {{ $courses }}
                            ],

                            backgroundColor: [
                                '#0d6efd',
                                '#198754',
                                '#ffc107',
                                '#dc3545'
                            ],

                            borderRadius: 8,
                            borderWidth: 0

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
                                beginAtZero: true
                            }

                        }

                    }

                });

                //==========================
                // Student Status
                //==========================

                new Chart(document.getElementById('statusChart'), {

                    type: 'doughnut',

                    data: {

                        labels: [
                            'Active',
                            'Inactive'
                        ],

                        datasets: [{

                            data: [
                                {{ $activeStudents }},
                                {{ $inactiveStudents }}
                            ],

                            backgroundColor: [
                                '#198754',
                                '#dc3545'
                            ]

                        }]
                    },

                    options: {

                        responsive: true,

                        plugins: {

                            legend: {
                                position: 'bottom'
                            }

                        }

                    }

                });


                new Chart(document.getElementById('resultChart'), {

                    type: 'bar',

                    data: {

                        labels: [
                            'Pass',
                            'Fail'
                        ],

                        datasets: [{

                            label: 'Students',

                            data: [
                                {{ $passStudents }},
                                {{ $failStudents }}
                            ],

                            backgroundColor: [
                                '#198754',
                                '#dc3545'
                            ],

                            borderRadius: 8,
                            borderSkipped: false,
                            barThickness: 50

                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

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

            });
        </script>
    @endpush

@endsection

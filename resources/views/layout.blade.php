<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>

        @yield('title')

        @if (isset($setting))
            | {{ $setting->site_name }}
        @endif

    </title>

    @if (isset($setting) && $setting->favicon)
        <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/png">
    @endif

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {

            background: #f4f6f9;

            overflow-x: hidden;

        }

        a {

            text-decoration: none;

        }

        ul {

            list-style: none;

            padding: 0;

            margin: 0;

        }

        /* ==========================
                SIDEBAR
        =========================== */

        .sidebar {

            position: fixed;

            left: 0;

            top: 0;

            width: 270px;

            height: 100vh;

            background: #343a40;

            color: #fff;

            transition: .3s;

            z-index: 999;

            overflow-y: auto;

        }

        .brand {

            height: 70px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 24px;

            font-weight: 700;

            border-bottom: 1px solid rgba(255, 255, 255, .1);

            background: #2f3542;

        }

        .brand i {

            margin-right: 10px;

            color: #17a2b8;

        }

        .sidebar-menu {

            padding: 15px;

        }

        .sidebar-menu li {

            margin-bottom: 6px;

        }

        .sidebar-menu li a {

            display: flex;

            align-items: center;

            color: #c2c7d0;

            padding: 13px 15px;

            border-radius: 8px;

            transition: .3s;

            font-size: 15px;

            font-weight: 500;

        }

        .sidebar-menu li a i {

            width: 25px;

            font-size: 18px;

        }

        .sidebar-menu li a:hover {

            background: #0d6efd;

            color: #fff;

        }

        .sidebar-menu li a.active {

            background: #0d6efd;

            color: #fff;

        }

        .sidebar-logo-brand {
            width: 100%;
            height: 115px;

            display: flex;
            align-items: center;

            padding: 7px 12px;
            gap: 10px;

            background: #16213e;
            border-bottom: 2px solid #2196f3;

            overflow: hidden;
        }


        /* LOGO 100px */
        .sidebar-logo-image {
            width: 100px;
            height: 100px;

            min-width: 100px;
            min-height: 100px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            background: #fff;

            padding: 3px;

            border: 2px solid rgba(255, 255, 255, .35);

            box-shadow: 0 5px 15px rgba(0, 0, 0, .35);

            overflow: hidden;
            flex-shrink: 0;
        }

        .sidebar-logo-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
            display: block;
        }


        /* TEXT */
        .sidebar-logo-name {
            min-width: 0;
            flex: 1;

            display: flex;
            flex-direction: column;
            justify-content: center;

            overflow: hidden;
        }


        /* STUDENT */
        .logo-student {
            color: #fff;

            font-size: 20px;
            font-weight: 700;

            line-height: 1.1;

            margin-bottom: 5px;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        /* MANAGEMENT SYSTEM */
        .logo-management {
            color: #2196f3;

            font-size: 11px;
            font-weight: 600;

            line-height: 1.1;

            white-space: nowrap;

            overflow: hidden;
            text-overflow: ellipsis;

            max-width: 100%;
        }


        @media(max-width: 992px) {

            .sidebar-logo-brand {
                height: 115px;
                padding: 7px 12px;
                gap: 10px;
            }

            .sidebar-logo-image {
                width: 100px;
                height: 100px;

                min-width: 100px;
                min-height: 100px;
            }

            .logo-student {
                font-size: 18px;
            }

            .logo-management {
                font-size: 10px;
            }
        }

        /* ==========================
   MOBILE SIDEBAR CLOSE BUTTON
========================== */

        .sidebar-close-btn {
            display: none;
        }


        /* ==========================
   MOBILE SIDEBAR
========================== */

        @media (max-width: 992px) {

            .sidebar {
                height: 100dvh;
                max-height: 100dvh;

                overflow-y: auto;
                overflow-x: hidden;

                -webkit-overflow-scrolling: touch;

                touch-action: pan-y;

                overscroll-behavior: contain;

                scrollbar-width: thin;
            }

            .sidebar-close-btn {
                display: flex;

                position: absolute;
                top: 15px;
                right: 12px;

                width: 38px;
                height: 38px;

                align-items: center;
                justify-content: center;

                border: none;
                border-radius: 50%;

                background: rgba(255, 255, 255, 0.12);
                color: #fff;

                font-size: 18px;

                cursor: pointer;

                z-index: 1005;

                transition: all .25s ease;
            }

            .sidebar-close-btn:hover {
                background: #dc3545;
                color: #fff;
                transform: rotate(90deg);
            }

            .sidebar.active {
                margin-left: 0;
            }
        }



        /* ==========================
                MAIN AREA
        =========================== */

        .main {

            margin-left: 270px;

            min-height: 100vh;

            transition: .3s;

        }

        /* ==========================
                NAVBAR
        =========================== */

        .topbar {

            height: 70px;

            background: #fff;

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 0 25px;

            box-shadow: 0 2px 15px rgba(0, 0, 0, .08);

            position: sticky;

            top: 0;

            z-index: 100;

        }

        .topbar-left {

            display: flex;

            align-items: center;

            gap: 20px;

        }

        .menu-btn {

            font-size: 24px;

            cursor: pointer;

            color: #555;

        }

        /* ==========================
              SEARCH BOX
          =========================== */

        .search-box {

            width: 420px;

            position: relative;

        }


        .search-box .input-group {

            background: #f8f9fa;

            border-radius: 30px;

            overflow: hidden;

            border: 1px solid #e5e5e5;

        }


        .search-box input {

            height: 42px;

            border: none;

            outline: none;

            background: transparent;

            padding: 0 15px;

            font-size: 14px;

            box-shadow: none;

        }


        .search-box input::placeholder {

            color: #9a9a9a;

        }


        .search-box input:focus {

            box-shadow: none;

            background: #fff;

        }


        .search-box button {

            width: 45px;

            height: 42px;

            border-radius: 0;

            border: none;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .search-box button:hover {

            background: #0056d6;

        }

        .topbar-right {

            display: flex;

            align-items: center;

            gap: 20px;

        }

        .notification {

            position: relative;

            cursor: pointer;

        }

        .notification i {

            font-size: 22px;

        }

        .notification span {

            position: absolute;

            top: -5px;

            right: -8px;

            width: 18px;

            height: 18px;

            background: red;

            color: #fff;

            border-radius: 50%;

            font-size: 10px;

            display: flex;

            align-items: center;

            justify-content: center;

        }

        .profile {

            display: flex;

            align-items: center;

            gap: 10px;

            cursor: pointer;

        }

        .profile img {

            width: 45px;

            height: 45px;

            border-radius: 50%;

            object-fit: cover;

        }

        /* ==========================
                CONTENT
        =========================== */

        .content {

            padding: 25px;

        }

        .page-title {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 25px;

        }

        .page-title h3 {

            font-weight: 700;

            margin: 0;

        }

        /* ===========================================================
               Dashboard Cards
                =========================================================== */

        .card {
            border: 0;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .08);
            transition: all .35s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .18);
        }

        .card .card-header {
            background: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }

        .card .card-body {
            padding: 20px;
        }

        .card i {
            transition: all .3s ease;
        }

        .card:hover i {
            transform: scale(1.15);
        }

        /* Table Hover */

        .table tbody tr {
            transition: all .25s ease;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        /* Buttons */

        .btn {
            transition: all .3s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
        }

        /* ===========================================================
                  AdminLTE Small Boxes
          =========================================================== */

        .small-box {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            color: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .15);
            transition: all .35s ease;
        }

        .small-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, .22);
        }

        .small-box .inner {
            padding: 20px;
        }

        .small-box h3 {
            font-size: 34px;
            font-weight: 700;
            margin: 0;
        }

        .small-box p {
            margin-top: 8px;
            font-size: 16px;
        }

        .small-box .icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 70px;
            opacity: .25;
            transition: all .35s ease;
        }

        .small-box:hover .icon {
            transform: scale(1.2) rotate(-8deg);
        }

        .small-box-footer {
            display: block;
            text-align: center;
            padding: 10px;
            text-decoration: none;
            color: #fff;
            background: rgba(0, 0, 0, .15);
            transition: all .3s ease;
        }

        .small-box-footer:hover {
            color: #fff;
            background: rgba(0, 0, 0, .25);
            letter-spacing: 1px;
        }

        /* Colors */

        .bg-info {
            background: #17a2b8;
        }

        .bg-success {
            background: #28a745;
        }

        .bg-warning {
            background: #ffc107;
            color: #fff;
        }

        .bg-danger {
            background: #dc3545;
        }






        ///////// Timeline
        .timeline {

            position: relative;

        }

        .timeline::before {

            content: '';

            position: absolute;

            left: 18px;

            top: 0;

            bottom: 0;

            width: 3px;

            background: #dee2e6;

        }

        .timeline .d-flex {

            position: relative;

            padding-left: 10px;

        }

        .timeline .badge {

            width: 42px;

            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

        }

        /* ==========================
             RESPONSIVE
        =========================== */

        @media(max-width:992px) {


            .sidebar {

                margin-left: -270px;

            }


            .sidebar.active {

                margin-left: 0;

            }


            .main {

                margin-left: 0;

            }


            .topbar {

                height: 70px;

                padding: 0 12px;

                flex-wrap: nowrap;

            }


            .topbar-left {

                display: flex;

                align-items: center;

                gap: 10px;

                width: 100%;

            }


            .menu-btn {

                font-size: 22px;

            }


            .search-box {

                display: block !important;

                width: 100%;

                max-width: 220px;

            }


            .search-box input {

                height: 38px;

                font-size: 12px;

                padding: 8px 10px;

            }


            .search-box button {

                height: 38px;

                width: 40px;

                padding: 0;

            }


            .topbar-right {

                display: flex;

                align-items: center;

                gap: 10px;

                width: auto;

                margin: 0;

            }


            .profile div {

                display: none;

            }


            .profile img {

                width: 38px;

                height: 38px;

            }


            .notification i {

                font-size: 20px;

            }


        }

        .notification-dropdown {
            width: 350px;
            padding: 0;
        }

        .notification-dropdown .dropdown-item {
            white-space: normal;
            transition: .3s;
        }

        .notification-dropdown .dropdown-item:hover {
            background: #f8f9fa;
        }

        .notification-message {
            display: block;
            white-space: normal;
            word-break: break-word;
            overflow-wrap: break-word;
            line-height: 1.4;
            max-width: 100%;
        }

        .notification-dropdown .dropdown-divider {
            margin: 0;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: transparent;
            border-radius: 20px;
        }

        .sidebar:hover::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.4);
        }

        .sidebar:hover::-webkit-scrollbar-thumb:hover {
            background: #17a2b8;
        }

        .teacher-chart-container {
            position: relative;
            width: 100%;
            height: 330px;
        }

        #teacherAttendanceChart {
            width: 100% !important;
            height: 100% !important;
        }

        @media (max-width: 768px) {

            .teacher-chart-container {
                height: 280px;
            }

        }

        @media (max-width: 480px) {

            .teacher-chart-container {
                height: 240px;
            }
        }

        .logout-btn {
            color: #dc3545 !important;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: rgba(220, 53, 69, 0.12) !important;
            color: #dc3545 !important;
        }
    </style>

</head>

<body>

    <!-- ========= SIDEBAR START ========= -->

    <div class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-logo-brand">
            <div class="sidebar-logo-image">
                @if (isset($setting) && $setting->logo)
                    <img src="{{ asset($setting->logo) }}" alt="Logo">
                @else
                    <i class="bi bi-mortarboard-fill"></i>
                @endif
            </div>
            @php
                $siteName = $setting->site_name ?? 'Student Management System';
                $words = explode(' ', trim($siteName));
                $firstWord = array_shift($words);
                $remainingWords = implode(' ', $words);
            @endphp

            <div class="sidebar-logo-name">
                <div class="logo-student">
                    {{ $firstWord }}
                </div>
                <div class="logo-management">
                    {{ $remainingWords }}
                </div>
            </div>
        </a>

        <button type="button" class="sidebar-close-btn" id="sidebar-close">
            <i class="bi bi-x-lg"></i>
        </button>

        <ul class="sidebar-menu">
            <li>

                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <i class="bi bi-speedometer2"></i>

                    Dashboard

                </a>

            </li>

            @can('viewAny', App\Models\Student::class)
                <li>
                    <a href="{{ route('students.index') }}">
                        <i class="bi bi-people-fill"></i>
                        Students
                    </a>
                </li>
            @endcan


            @can('viewAny', App\Models\Department::class)
                <li>

                    <a href="{{ route('departments.index') }}">

                        <i class="bi bi-building"></i>

                        Departments

                    </a>

                </li>
            @endcan

            @can('viewAny', App\Models\Course::class)
                <li>
                    <a href="{{ route('courses.index') }}">

                        <i class="bi bi-book-fill"></i>

                        Courses

                    </a>
                </li>
            @endcan

            @can('viewAny', App\Models\Teacher::class)
                <li>
                    <a href="{{ route('teachers.index') }}"
                        class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">

                        <i class="bi bi-person-workspace"></i>
                        Teachers
                    </a>
                </li>
            @endcan


            @can('viewAny', App\Models\Subject::class)
                <li>
                    <a href="{{ route('subjects.index') }}"
                        class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        Subjects
                    </a>
                </li>
            @endcan


            @can('viewAny', App\Models\Attendance::class)
                <li>
                    <a href="{{ route('attendances.index') }}"
                        class="{{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check-fill"></i>
                        Attendance
                    </a>
                </li>
            @endcan



            <li>
                <a href="{{ route('results.index') }}" class="{{ request()->routeIs('results.*') ? 'active' : '' }}">
                    <i class="bi bi-award-fill"></i>
                    Results
                </a>
            </li>

            @can('viewReport', App\Models\Report::class)
                <li>
                    <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('results.*') ? 'active' : '' }}">
                        <i class="bi bi-award-fill"></i>
                        Reports
                    </a>
                </li>
            @endcan


            <li>
                <a href="{{ route('settings.index') }}">
                    <i class="bi bi-gear-fill"></i>
                    Settings
                </a>
            </li>

            @if (auth()->user()->role == 'Admin')
                <li>
                    <a href="{{ route('activities.index') }}" class="nav-link">
                        <i class="bi bi-clock-history"></i>
                        Recent Activity
                    </a>
                </li>
            @endif





            <li style="border-top: 1px solid rgba(255,255,255,0.15); margin-top: 8px; padding-top: 8px;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="logout-btn w-100 border-0 bg-transparent text-start px-3 py-3 rounded">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </button>
                </form>
            </li>


        </ul>

    </div>

    <!-- =========================
            MAIN START
                ========================= -->

    <div class="main">

        <!-- =========================
            TOP NAVBAR
              ========================= -->

        <div class="topbar">

            <div class="topbar-left">

                <div class="menu-btn" id="menu-btn">

                    <i class="bi bi-list"></i>

                </div>

                <div class="search-box position-relative">
                    <div class="input-group">
                        <input type="text" id="globalSearch" class="form-control"
                            placeholder="Search Student, Teacher, Department, Course, Subject">
                        <button class="btn btn-primary" id="searchBtn">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>


            </div>

            <div class="topbar-right">

                @can('manage-notifications')
                    <!-- Notification -->
                    <div class="dropdown">

                        <a href="#" class="notification text-dark position-relative" data-bs-toggle="dropdown">
                            <i class="bi bi-bell-fill"></i>

                            @if ($unreadNotifications > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $unreadNotifications }}
                                </span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 notification-dropdown">

                            <li class="dropdown-header d-flex justify-content-between align-items-center">
                                <strong>Notifications</strong>

                                <form action="{{ route('notifications.readAll') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-link text-decoration-none p-0">
                                        Mark All Read
                                    </button>
                                </form>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            @forelse($navbarNotifications as $notification)
                                <li>

                                    <a class="dropdown-item py-2"
                                        href="{{ route('notifications.read', $notification->id) }}">

                                        <div class="d-flex align-items-start">

                                            <div class="me-3 flex-shrink-0">
                                                <i
                                                    class="fas {{ $notification->icon }} text-{{ $notification->color }} fs-5"></i>
                                            </div>

                                            <div class="flex-grow-1 overflow-hidden">

                                                <div class="fw-bold text-dark">
                                                    {{ $notification->title }}
                                                </div>

                                                <small class="text-muted d-block notification-message">
                                                    {{ $notification->message }}
                                                </small>

                                                <small class="text-secondary d-block mt-1">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </small>

                                            </div>

                                            @if (!$notification->is_read)
                                                <span class="badge bg-danger ms-2 flex-shrink-0">
                                                    New
                                                </span>
                                            @endif

                                        </div>

                                    </a>

                                </li>

                            @empty

                                <li>
                                    <div class="text-center py-3 text-muted">
                                        No Notifications
                                    </div>
                                </li>
                            @endforelse

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item text-center fw-bold" href="{{ route('notifications.index') }}">
                                    View All Notifications
                                </a>
                            </li>

                        </ul>

                    </div>
                @endcan

                <!-- Profile -->

                <div class="dropdown">

                    <a href="#" class="profile text-dark text-decoration-none" data-bs-toggle="dropdown">

                        @if (auth()->user()->image)
                            <img src="{{ asset('uploads/profile/' . auth()->user()->image) }}"
                                alt="{{ auth()->user()->name }}" class="profile-image">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}"
                                alt="{{ auth()->user()->name ?? 'Admin' }}" class="profile-image">
                        @endif

                        <div>
                            <strong>
                                {{ auth()->user()->name ?? 'Admin' }}
                            </strong>

                            <br>

                            <small class="text-muted">
                                {{ auth()->user()->role ?? 'Administrator' }}
                            </small>
                        </div>

                    </a>




                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person-circle me-2"></i>
                                Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="">
                                <i class="bi bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>

                </div>

            </div>

        </div>

        <!-- =========================
            CONTENT START
              ========================= -->

        <div class="content">

            <div class="page-title">

                <h3>

                    @yield('title')

                </h3>

                <nav>

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item">

                            <a href="{{ route('dashboard') }}">Home</a>

                        </li>

                        <li class="breadcrumb-item active">

                            @yield('title')

                        </li>

                    </ol>

                </nav>

            </div>


            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center justify-content-between mb-3">

                    <span>
                        {{ session('status') }}
                    </span>

                    <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close">
                    </button>

                </div>
            @endif



            @yield('content')


            <!-- Page Content -->

        </div>

        <!-- ===========================
            FOOTER
            ============================ -->

        <footer class="bg-white border-top py-3 px-4 mt-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    {{ $setting->site_name ?? 'Student Management System' }}

                    <br>

                    <small class="text-muted">

                        © {{ date('Y') }} All Rights Reserved.

                    </small>

                </div>

                <div>

                    <small class="text-muted">

                        Version 1.0.0

                    </small>

                </div>

            </div>

        </footer>

    </div>

    <!-- ===========================
            Bootstrap JS
         ============================ -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ===========================
            Sidebar Toggle
            ============================ -->

    <script>
        const sidebar = document.getElementById("sidebar");
        const menuBtn = document.getElementById("menu-btn");
        const closeBtn = document.getElementById("sidebar-close");
        const sidebarOverlay = document.getElementById("sidebar-overlay");

        // Open / Toggle Sidebar
        menuBtn.addEventListener("click", function() {

            if (window.innerWidth <= 992) {

                sidebar.classList.add("active");
                sidebarOverlay.classList.add("active");

            } else {

                if (sidebar.style.width == "80px") {

                    sidebar.style.width = "270px";
                    document.querySelector(".main").style.marginLeft = "270px";

                    document.querySelectorAll(".sidebar-menu a").forEach(function(item) {
                        item.style.justifyContent = "start";
                    });

                } else {

                    sidebar.style.width = "80px";
                    document.querySelector(".main").style.marginLeft = "80px";

                    document.querySelectorAll(".sidebar-menu a").forEach(function(item) {
                        item.style.justifyContent = "center";
                    });

                }
            }
        });


        // Close Sidebar
        closeBtn.addEventListener("click", function() {

            sidebar.classList.remove("active");
            sidebarOverlay.classList.remove("active");

        });


        // Close Sidebar when clicking outside
        sidebarOverlay.addEventListener("click", function() {

            sidebar.classList.remove("active");
            sidebarOverlay.classList.remove("active");

        });


        // Close Sidebar after clicking a menu link on mobile
        document.querySelectorAll(".sidebar-menu a").forEach(function(link) {

            link.addEventListener("click", function() {

                if (window.innerWidth <= 992) {

                    sidebar.classList.remove("active");
                    sidebarOverlay.classList.remove("active");

                }

            });

        });
    </script>

    <!-- ===========================
            Active Menu
           =========================== -->

    <script>
        const links = document.querySelectorAll(".sidebar-menu a");

        links.forEach(function(link) {

            link.addEventListener("click", function() {

                links.forEach(l => l.classList.remove("active"));

                this.classList.add("active");

            });

        });
    </script>

    @stack('scripts');



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {

            function globalSearch() {

                let search = $("#globalSearch").val().trim();

                if (search == "") {
                    return;
                }

                $.ajax({

                    url: "{{ route('global.search') }}",

                    type: "GET",

                    data: {
                        search: search
                    },

                    success: function(response) {

                        if (response.status) {

                            window.location.href = response.url;

                        } else {

                            alert("No Record Found");

                        }

                    },

                    error: function(xhr) {

                        console.log(xhr.responseText);

                    }

                });

            }


            // Button Search

            $("#searchBtn").click(function() {

                globalSearch();

            });


            // Enter Press

            $("#globalSearch").keypress(function(e) {

                if (e.which == 13) {

                    e.preventDefault();

                    globalSearch();

                }

            });

        });
    </script>

    {{-- <script>
        $(function() {

            let timer;

            $("#globalSearch").on("keyup", function() {

                clearTimeout(timer);

                let search = $(this).val().trim();

                if (search == "") {
                    return;
                }

                timer = setTimeout(function() {

                    $.ajax({

                        url: "{{ route('global.search') }}",

                        type: "GET",

                        data: {
                            search: search
                        },

                        success: function(response) {

                            if (response.status) {

                                window.location.href = response.url;

                            }

                        }

                    });

                }, 500); // 500ms delay

            });

        });
    </script> --}}
</body>

</html>

{{-- @extends('layouts.auth')

@section('title', 'Register')


@section('content')


<div class="text-center mb-4">


    <div class="logo">

        <i class="fa fa-user-plus"></i>

    </div>


    <h2 class="mt-3 fw-bold">
        Create Account
    </h2>


    <p class="text-muted">
        Student Management System
    </p>


</div>



<form action="{{route('register.store')}}" method="POST">

    @csrf


    <div class="mb-3">

        <label>Name</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fa fa-user"></i>
            </span>
            <input type="text" name="name" class="form-control" placeholder="Enter Name">
        </div>
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>



    <div class="mb-3">


        <label>Email</label>

        <div class="input-group">
            <span class="input-group-text">
                <i class="fa fa-envelope"></i>
            </span>
            <input type="email" name="email" class="form-control" placeholder="Enter Email">
        </div>
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>




    <div class="mb-3">


        <label>Password</label>


        <div class="input-group">
            <span class="input-group-text">
                <i class="fa fa-lock"></i>
            </span>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>




    <div class="mb-3">


        <label>Role</label>

        <select name="role" class="form-select">
            <option value="">Select Role</option>

            <option>Admin</option>

            <option>Teacher</option>

            <option>Student</option>
        </select>
        @error('role')
        <span class="text-danger">{{ $message }}</span>
        @enderror

    </div>




    <button class="btn btn-success w-100">

        Register

    </button>



</form>




<div class="text-center mt-3">


    Already have account?

    <a href="{{route('login')}}">
        Login
    </a>


</div>


@endsection --}}






@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    <div class="text-center mb-4">


        <div class="logo">

            <i class="fa fa-user-plus"></i>

        </div>


        <h2 class="mt-3 fw-bold">
            Create Account
        </h2>


        <p class="text-muted">
            Student Management System
        </p>


    </div>

    <form action="{{ route('register.store') }}" method="POST">

        @csrf

        {{-- Email --}}
        <div class="mb-3">

            <label for="email" class="form-label">
                Email
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa fa-envelope"></i>
                </span>

                <input type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter your registered email"
                    value="{{ old('email') }}" required autofocus>

            </div>

            @error('email')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Password --}}
        <div class="mb-3">

            <label for="password" class="form-label">
                Password
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                </span>

                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Create password" required>

            </div>

            @error('password')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>


        {{-- Confirm Password --}}
        <div class="mb-3">

            <label for="password_confirmation" class="form-label">
                Confirm Password
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                </span>

                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Confirm password" required>

            </div>

        </div>


        {{-- Information --}}
        <div class="alert alert-info small">

            <i class="fa fa-info-circle me-1"></i>

            Registration is available only for students and teachers
            added by the administrator.

        </div>


        {{-- Register Button --}}
        <button type="submit" class="btn btn-success w-100">

            <i class="fa fa-user-plus me-1"></i>
            Register

        </button>


    </form>

    <div class="text-center mt-3">
        Already have account?

        <a href="{{ route('login') }}">
            Login
        </a>
    </div>


@endsection

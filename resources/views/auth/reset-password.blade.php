@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')

    <div class="text-center">

        <div class="logo">
            <i class="fa fa-key"></i>
        </div>

        <h2 class="mt-3 fw-bold">
            Forgot Password
        </h2>

        <p class="text-muted">
            Enter your email and create a new password.
        </p>

    </div>


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <form action="{{ route('password.update') }}" method="POST">

        @csrf

        <div class="mb-3">

            <label>Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa fa-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Enter Your Email"
                    value="{{ old('email') }}" required>
            </div>

        </div>



        <div class="mb-3">
            <label>New Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter New Password"
                    required>
                <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
        </div>



        <div class="mb-4">
            <label>Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa fa-check"></i>
                </span>
                <input type="password" id="confirmPassword" name="password_confirmation" class="form-control"
                    placeholder="Confirm Password" required>
                <span class="input-group-text" id="toggleConfirmPassword" style="cursor:pointer;">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
        </div>


        <button type="submit" class="btn btn-primary w-100">

            <i class="fa fa-key me-2"></i>

            Reset Password

        </button>

    </form>



    <div class="text-center mt-4">

        <a href="{{ route('login') }}">

            <i class="fa fa-arrow-left me-1"></i>

            Back to Login

        </a>

    </div>



@endsection

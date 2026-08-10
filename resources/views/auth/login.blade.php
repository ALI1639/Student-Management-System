@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="text-center">

        <div class="logo">

            <i class="fa fa-user"></i>

        </div>

        <h2 class="mt-3 fw-bold">

            Welcome Back

        </h2>

        <p class="text-muted">

            Login to continue

        </p>

    </div>



    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif



    <form action="{{ route('login.store') }}" method="POST">

        @csrf


        <div class="mb-3">

            <label>Email</label>

            <div class="input-group">

                <span class="input-group-text">

                    <i class="fa fa-envelope"></i>

                </span>

                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter Email" value="{{ old('email') }}">

            </div>

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>





        <div class="mb-3">

            <label>Password</label>

            <div class="input-group">

                <span class="input-group-text">

                    <i class="fa fa-lock"></i>

                </span>

                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password">

            </div>

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>



        <div class="d-flex justify-content-end mb-3">

            <a href="{{ route('admin.password') }}" class="text-decoration-none">

                <i class="fa fa-key me-1"></i>

                Forgot Password?

            </a>

        </div>



        <button class="btn btn-primary w-100">

            <i class="fa fa-right-to-bracket"></i>

            Login

        </button>

    </form>




    <div class="text-center mt-4">

        Don't have an account?

        <a href="{{ route('register') }}">
            Register
        </a>

    </div>

@endsection

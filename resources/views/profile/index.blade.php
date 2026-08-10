@extends('layout')

@section('title')
    Profile
@endsection


@section('content')
    <div class="container-fluid">


        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    <i class="bi bi-person-circle"></i>
                    My Profile
                </h5>

            </div>



            <div class="card-body">


                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif



                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">


                    @csrf



                    <div class="row">



                        <!-- Profile Image -->

                        <div class="col-md-4 text-center mb-3">


                            @if ($user->image)
                                <img src="{{ asset('uploads/profile/' . $user->image) }}" class="rounded-circle shadow"
                                    width="150" height="150">
                            @else
                                <img src="{{ asset('images/default.png') }}" class="rounded-circle shadow" width="150"
                                    height="150">
                            @endif



                            <div class="mt-3">

                                <input type="file" name="image" class="form-control">

                            </div>


                        </div>




                        <!-- Details -->

                        <div class="col-md-8">


                            <div class="mb-3">

                                <label class="form-label">
                                    Name
                                </label>

                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">

                            </div>



                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">

                            </div>




                            <div class="mb-3">

                                <label class="form-label">
                                    Role
                                </label>

                                <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>

                            </div>




                            <div class="mb-3">

                                <label class="form-label">
                                    Phone
                                </label>

                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">

                            </div>




                            <div class="mb-3">

                                <label class="form-label">
                                    Address
                                </label>

                                <textarea name="address" class="form-control" rows="3">{{ $user->address }}</textarea>

                            </div>


                        </div>


                    </div>



                    <hr>



                    <h5 class="mb-3">
                        Change Password
                    </h5>



                    <div class="row">


                        <div class="col-md-6">

                            <label class="form-label">
                                New Password
                            </label>

                            <input type="password" name="password" class="form-control">

                        </div>



                        <div class="col-md-6">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input type="password" name="password_confirmation" class="form-control">

                        </div>


                    </div>



                    <div class="mt-4 text-end">


                        <button type="submit" class="btn btn-primary">

                            <i class="bi bi-save"></i>
                            Update Profile

                        </button>

                        <a href="{{ route('dashboard') }}" class="btn btn-dark">Back</a>


                    </div>



                </form>


            </div>


        </div>


    </div>
@endsection

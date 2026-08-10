@extends('layout')

@section('title', 'Settings')


@section('content')


    <div class="container-fluid">


        <div class="row mb-3">

            <div class="col-md-12">

                <h3>

                    <i class="fas fa-cogs text-primary"></i>

                    System Settings

                </h3>

            </div>

        </div>




        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>
        @endif





        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif





        <div class="card shadow border-0">


            <div class="card-header bg-primary text-white">


                <h5 class="mb-0">

                    <i class="fas fa-sliders-h"></i>

                    Website Settings

                </h5>


            </div>




            <div class="card-body">



                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">


                    @csrf



                    <div class="row">





                        <div class="col-md-6 mb-3">


                            <label class="form-label">

                                Site Name

                            </label>


                            <input type="text" name="site_name" class="form-control"
                                value="{{ old('site_name', $setting->site_name) }}">


                        </div>





                        <div class="col-md-6 mb-3">


                            <label class="form-label">

                                Site Email

                            </label>


                            <input type="email" name="site_email" class="form-control"
                                value="{{ old('site_email', $setting->site_email) }}">


                        </div>





                        <div class="col-md-6 mb-3">


                            <label class="form-label">

                                Phone

                            </label>


                            <input type="text" name="site_phone" class="form-control"
                                value="{{ old('site_phone', $setting->site_phone) }}">


                        </div>





                        <div class="col-md-6 mb-3">


                            <label class="form-label">

                                Currency

                            </label>


                            <input type="text" name="currency" class="form-control"
                                value="{{ old('currency', $setting->currency) }}">


                        </div>





                        <div class="col-md-12 mb-3">


                            <label class="form-label">

                                Address

                            </label>


                            <textarea name="site_address" class="form-control" rows="3">{{ old('site_address', $setting->site_address) }}</textarea>


                        </div>





                        <div class="col-md-6 mb-3">


                            <label class="form-label">

                                Timezone

                            </label>


                            <select name="timezone" class="form-select">


                                <option value="Asia/Karachi" {{ $setting->timezone == 'Asia/Karachi' ? 'selected' : '' }}>

                                    Asia/Karachi

                                </option>



                                <option value="Asia/Dubai" {{ $setting->timezone == 'Asia/Dubai' ? 'selected' : '' }}>

                                    Asia/Dubai

                                </option>



                                <option value="UTC" {{ $setting->timezone == 'UTC' ? 'selected' : '' }}>

                                    UTC

                                </option>


                            </select>


                        </div>





                        <div class="col-md-6 mb-3">


                            <label class="form-label">

                                Maintenance Mode

                            </label>



                            <div class="form-check mt-2">


                                <input type="checkbox" name="maintenance_mode" value="1" class="form-check-input"
                                    {{ $setting->maintenance_mode ? 'checked' : '' }}>


                                <label class="form-check-label">

                                    Enable Maintenance Mode

                                </label>


                            </div>


                        </div>





                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Logo
                            </label>
                            <input type="file" name="logo" class="form-control">
                            @if ($setting->logo)
                                <img src="{{ asset($setting->logo) }}" width="200" class="img-thumbnail mt-2">
                            @endif
                        </div>





                        <div class="col-md-6 mb-3">


                            <label class="form-label">

                                Favicon

                            </label>


                            <input type="file" name="favicon" class="form-control">



                            @if ($setting->favicon)
                                <img src="{{ asset($setting->favicon) }}" width="60" class="img-thumbnail mt-2">
                            @endif


                        </div>



                    </div>





                    <button class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Save Settings
                    </button>

                    <a href="{{ route('dashboard') }}" class="btn btn-dark">Back</a>



                </form>



            </div>


        </div>


    </div>


@endsection

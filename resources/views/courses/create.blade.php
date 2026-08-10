@extends('layout')


@section('title')
Add New Course
@endsection


@section('content')
<form action="{{ route('courses.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"
                name="name" placeholder="Enter your department">
            <span class="text-danger">
                @error('name')
                {{ $message }}
                @enderror
            </span>
        </div>

        <!-- Code -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Course Code</label>
            <input type="text" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror"
                name="code" placeholder="Enter your Code">
            <span class="text-danger">
                @error('code')
                {{ $message }}
                @enderror
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Credit Hours</label>
            <input type="number" value="{{ old('hours') }}" class="form-control @error('hours') is-invalid @enderror"
                name="hours" placeholder="Enter your hours">
            <span class="text-danger">
                @error('hours')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Semester</label>
            <input type="number" value="{{ old('semester') }}"
                class="form-control @error('semester') is-invalid @enderror" name="semester"
                placeholder="Enter your semester">
            <span class="text-danger">
                @error('semester')
                {{ $message }}
                @enderror
            </span>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Department</label>
            <select name="department" class="form-select @error('department') is-invalid @enderror">
                <option value="">Select Department</option>
                @foreach($departments as $depart)
                <option value=" {{ $depart->id }}" {{ old('department')==$depart->id ? 'selected' : "" }}>{{
                    $depart->name }}</option>
                @endforeach
            </select>
            @error('department')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="">Select Status</option>
                <option value="1" {{ old('status')=='1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status')=='0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <!-- Button -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
        <a href="{{ route('courses.index') }}" class="btn btn-dark">Back</a>
    </div>

</form>

@endsection
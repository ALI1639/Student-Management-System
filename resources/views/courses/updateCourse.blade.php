@extends('layout')


@section('title')
Upadate Course
@endsection


@section('content')
<form action="{{ route('courses.update', $course->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Name -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" value="{{ $course->name }}" class="form-control @error('name') is-invalid @enderror"
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
            <input type="text" value="{{ $course->code }}" class="form-control @error('code') is-invalid @enderror"
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
            <input type="number" value="{{ $course->credit_hours }}"
                class="form-control @error('hours') is-invalid @enderror" name="hours" placeholder="Enter your hours">
            <span class="text-danger">
                @error('hours')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Semester</label>
            <input type="number" value="{{ $course->semester }}"
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
            <select name="department_id" class="form-select">
                @foreach ($departments as $depart)
                <option value="{{ $depart->id }}" {{ $course->department_id == $depart->id ? 'selected' : '' }}>
                    {{ $depart->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
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
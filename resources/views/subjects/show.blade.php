@extends('layout')

@section('title')
Add Subject
@endsection

@section('content')

<div class="container">

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf

        <div class="row">
            <!-- Subject Name -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Subject Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Enter Subject Name">

                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subject Code -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Subject Code</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                    value="{{ old('code') }}" placeholder="Enter Subject Code">

                @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Department -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Department</label>

                <select name="department_id" class="form-select @error('department_id') is-invalid @enderror">
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id')==$department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                    @endforeach
                </select>
                @error('department_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Course -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Course</label>
                <select name="course_id" class="form-select @error('course_id') is-invalid @enderror">
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id')==$course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                    @endforeach
                </select>
                @error('course_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Teachers -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Teachers</label>
                <select name="teacher_id[]" class="form-select @error('teacher_id') is-invalid @enderror" multiple>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">
                        {{ $teacher->name }}
                    </option>
                    @endforeach
                </select>
                <small class="text-muted">Ctrl + Click se multiple teachers select karein.</small>
                @error('teacher_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
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


        <button type="submit" class="btn btn-success">
            Save Subject
        </button>

        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
            Back
        </a>

    </form>

</div>

@endsection
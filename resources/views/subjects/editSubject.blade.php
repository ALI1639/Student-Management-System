@extends('layout')

@section('title')
Updated Subject
@endsection

@section('content')

<div class="container">

    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Subject Name -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Subject Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $subject->name) }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Subject Code -->
            <div class="col-md-6  mb-3">
                <label class="form-label">Subject Code</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                    value="{{ old('code', $subject->code) }}">
                @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Department -->
            <div class="col-md-6  mb-3">
                <label class="form-label">Department</label>
                <select name="department_id" class="form-select @error('department_id') is-invalid @enderror">
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $subject->department_id == $department->id ? 'selected' :
                        ''}}>
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
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $subject->course_id == $course->id ? 'selected' : '' }}>
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
                    <option value="{{ $teacher->id }}" {{ $subject->teachers->contains($teacher->id) ? 'selected' : ''
                        }}>
                        {{ $teacher->name }}
                    </option>
                    @endforeach
                </select>
                <small class="text-muted">
                    Ctrl + Click se multiple teachers select karein.
                </small>
                @error('teacher_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="1" {{ $subject->status == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $subject->status == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-3">
            <button type="submit" class="btn btn-warning">
                Update Subject
            </button>

            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

    </form>

</div>

@endsection
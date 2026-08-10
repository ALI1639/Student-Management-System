@extends('layout')


@section('title')
Add New Department
@endsection


@section('content')
<form action="{{ route('departments.store') }}" method="POST">
    @csrf
    <!-- Name -->
    <div class="col-md-4 mb-3">
        <label class="form-label">Name</label>
        <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"
            name="name" placeholder="Enter your department">
        <span class="text-danger">
            @error('name')
            {{ $message }}
            @enderror
        </span>
    </div>

    <!-- Code -->
    <div class="col-md-4  mb-3">
        <label class="form-label">Code</label>
        <input type="text" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror"
            name="code" placeholder="Enter your Code">
        <span class="text-danger">
            @error('code')
            {{ $message }}
            @enderror
        </span>
    </div>

    <!-- Status -->
    <div class="col-md-4 mb-3">
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

    <!-- Button -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
        <a href="{{ route('departments.index') }}" class="btn btn-dark">Back</a>
    </div>

</form>

@endsection
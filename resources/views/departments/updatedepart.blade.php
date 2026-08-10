@extends('layout')


@section('title')
Update Department
@endsection


@section('content')
<form action="{{ route('departments.update',$depart->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Name -->
    <div class="col-md-4 mb-3">
        <label class="form-label">Name</label>
        <input type="text" value="{{ $depart->name }}" class="form-control" name="name" placeholder="Enter your name">
    </div>

    <!-- Gmail -->
    <div class="col-md-4 mb-3">
        <label class="form-label">Code</label>
        <input type="text" value="{{ $depart->code }}" class="form-control" name="code" placeholder="Enter your gmail">

    </div>


    <div class="col-md-4 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="1" {{ old('status',$depart->status == 1 ? 'selected' : '') }}>Active
            </option>
            <option value="0" {{ old('status',$depart->status == 0 ? 'selected' : '') }}>Inactive</option>
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
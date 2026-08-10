@extends('layout')


@section('title')
Add New Teacher
@endsection


@section('content')
<form action="{{ route('teachers.store') }}" method="POST">
    @csrf

    <!-- Row 1 -->
    <div class="row">
        <div class=" col-md-6 mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class=" col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Row 2 -->
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="number" value="{{ old('number') }}"
                class="form-control @error('number') is-invalid @enderror" placeholder="Enter Phone Number">
            @error('number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender')=='Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender')=='Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender')=='other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label">Qualification</label>
            <input type="text" name="qualification" value="{{ old('qualification') }}"
                class="form-control @error('qualification') is-invalid @enderror" placeholder="Enter Semester">
            @error('qualification')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

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
    </div>

    <!-- Row 4 -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror"
                placeholder="Enter Address">{{ old('address') }}</textarea>
            @error('address')
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

    <button type="submit" class="btn btn-primary">
        Submit
    </button>

    <a href="{{ route('teachers.index') }}" class="btn btn-dark">Back</a>

</form>
@endsection
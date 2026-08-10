@extends('layout')

@section('title')
Student Details
@endsection

@section('content')


<table class="table table-bordered table-striped">

    <tr>
        <th width="220">Roll Number</th>
        <td>{{ $student->roll_number }}</td>
    </tr>

    <tr>
        <th>Name</th>
        <td>{{ $student->name }}</td>
    </tr>

    <tr>
        <th>Email</th>
        <td>{{ $student->email }}</td>
    </tr>

    <tr>
        <th>Phone Number</th>
        <td>{{ $student->phone }}</td>
    </tr>

    <tr>
        <th>Gender</th>
        <td>{{ $student->gender }}</td>
    </tr>

    <tr>
        <th>Department</th>
        <td>{{ $student->department->name }}</td>
    </tr>

    <tr>
        <th>Course</th>
        <td>{{ $student->course->name }}</td>
    </tr>

    <tr>
        <th>Date of Birth</th>
        <td>{{ $student->date_of_birth }}</td>
    </tr>

    <tr>
        <th>Address</th>
        <td>{{ $student->address }}</td>
    </tr>

    <tr>
        <th>Semester</th>
        <td>{{ $student->semester }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            @if($student->status == 1)
            <span class="badge bg-success">Active</span>
            @else
            <span class="badge bg-danger">Inactive</span>
            @endif
        </td>
    </tr>

</table>

<a href="{{ route('students.index') }}" class="btn btn-secondary">
    Back
</a>

@endsection
@extends('layout')

@section('title')
Teacher Details
@endsection

@section('content')


<table class="table table-bordered table-striped">

    <tr>
        <th width="220">Name</th>
        <td>{{ $teacher->name }}</td>
    </tr>

    <tr>
        <th>Email</th>
        <td>{{ $teacher->email }}</td>
    </tr>

    <tr>
        <th>Phone Number</th>
        <td>{{ $teacher->phone }}</td>
    </tr>

    <tr>
        <th>Gender</th>
        <td>{{ $teacher->gender }}</td>
    </tr>

    <tr>
        <th>Qualification</th>
        <td>{{ $teacher->qualification }}</td>
    </tr>

    <tr>
        <th>Department</th>
        <td>{{ $teacher->department->name }}</td>
    </tr>


    <tr>
        <th>Address</th>
        <td>{{ $teacher->address }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            @if($teacher->status == 1)
            <span class="badge bg-success">Active</span>
            @else
            <span class="badge bg-danger">Inactive</span>
            @endif
        </td>
    </tr>

</table>

<a href="{{ route('teachers.index') }}" class="btn btn-secondary">
    Back
</a>

@endsection
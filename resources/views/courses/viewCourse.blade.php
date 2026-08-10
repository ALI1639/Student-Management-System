{{-- @extends('layout')


@section('title')
View Detail
@endsection


@section('content')
<table class="table table-striped table-border">

    <tr>
        <th width="100px">Department :</th>
        <td>{{ $course->department->name }}</td>
    </tr>

    <tr>
        <th>Course Name</th>
        <td>{{ $course->name }}</td>
    </tr>

    <tr>
        <th>Course Code</th>
        <td>{{ $course->code }}</td>
    </tr>

    <tr>
        <th>Credit Hours</th>
        <td>{{ $course->credit_hours }}</td>
    </tr>

    <tr>
        <th>Semester</th>
        <td>{{ $course->semester }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            @if($course->status == 1)
            <span class="badge bg-success">Active</span>
            @else
            <span class="badge bg-danger">Inactive</span>
            @endif
        </td>
    </tr>
</table>
<a href="{{ route('courses.index') }}" class="btn btn-danger">Back</a>
@endsection --}}


@extends('layout')

@section('title')
Course Details
@endsection

@section('content')


<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">

        <tbody>
            <tr>
                <th style="width: 150px;">Department</th>
                <td>{{ $course->department->name }}</td>
            </tr>

            <tr>
                <th>Course Name</th>
                <td>{{ $course->name }}</td>
            </tr>

            <tr>
                <th>Course Code</th>
                <td>{{ $course->code }}</td>
            </tr>

            <tr>
                <th>Credit Hours</th>
                <td>{{ $course->credit_hours }}</td>
            </tr>

            <tr>
                <th>Semester</th>
                <td>{{ $course->semester }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if($course->status == 1)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
            </tr>
        </tbody>

    </table>
</div>

<div class="mt-3">
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

@endsection
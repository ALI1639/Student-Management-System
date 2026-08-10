@extends('layout')

@section('title')
    Subject Details
@endsection

@section('content')
    <div class="container">

        <table class="table table-bordered table-striped">

            <tr>
                <th width="220">ID</th>
                <td>{{ $subject->id }}</td>
            </tr>

            <tr>
                <th>Subject Name</th>
                <td>{{ $subject->name }}</td>
            </tr>

            <tr>
                <th>Subject Code</th>
                <td>{{ $subject->code }}</td>
            </tr>

            <tr>
                <th>Department</th>
                <td>{{ $subject->department?->name }}</td>
            </tr>

            <tr>
                <th>Course</th>
                <td>{{ $subject->course?->name }}</td>
            </tr>

            <tr>
                <th>Teachers</th>
                <td>
                    @forelse($subject->teachers as $teacher)
                        {{ $teacher->name }}<br>
                    @empty
                        <span class="text-danger">No Teacher Assigned</span>
                    @endforelse
                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if ($subject->status)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>
            </tr>

        </table>

        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">
            Back
        </a>


    </div>
@endsection

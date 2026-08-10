@extends('layout')

@section('title','Bulk Attendance')

@section('content')

<div class="container-fluid mt-3">



    {{-- Filter Form --}}

    <form method="GET" action="{{ route('attendances.create') }}">

        <table class="table table-bordered">

            <tr>

                <th width="180">
                    Department
                </th>

                <td>

                    <select name="department_id" class="form-select" required>

                        <option value="">
                            Select Department
                        </option>

                        @foreach($departments as $department)

                        <option value="{{ $department->id }}" {{ request('department_id')==$department->id ?
                            'selected':'' }}>

                            {{ $department->name }}

                        </option>

                        @endforeach

                    </select>

                </td>

            </tr>

            <tr>

                <th>
                    Subject
                </th>

                <td>

                    <select name="subject_id" class="form-select" required>

                        <option value="">
                            Select Subject
                        </option>

                        @foreach($subjects as $subject)

                        <option value="{{ $subject->id }}" {{ request('subject_id')==$subject->id ? 'selected':'' }}>

                            {{ $subject->name }}

                        </option>

                        @endforeach

                    </select>

                </td>

            </tr>

            <tr>

                <th>
                    Attendance Date
                </th>

                <td>

                    <input type="date" name="attendance_date" class="form-control"
                        value="{{ request('attendance_date',date('d-m-Y')) }}" required>

                </td>

            </tr>

            <tr>

                <td colspan="2" class="text-center">

                    <button class="btn btn-primary">Load Students</button>
                    <a href="/attendances" class="btn btn-dark">Back</a>
                </td>

            </tr>

        </table>

    </form>

    @if(request()->filled('department_id') && request()->filled('subject_id'))

    @if($students->count())

    <form action="{{ route('attendances.store') }}" method="POST">

        @csrf

        <input type="hidden" name="department_id" value="{{ request('department_id') }}">

        <input type="hidden" name="subject_id" value="{{ request('subject_id') }}">

        <input type="hidden" name="attendance_date" value="{{ request('attendance_date') }}">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>
                    <th>#</th>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>P</th>
                    <th>A</th>
                    <th>L</th>
                </tr>

            </thead>

            <tbody>

                @foreach($students as $student)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $student->roll_number }}</td>

                    <td>
                        {{ $student->name }}

                        <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                    </td>

                    <td class="text-center">
                        <input type="radio" name="status[{{ $student->id }}]" value="P" checked>
                    </td>

                    <td class="text-center">
                        <input type="radio" name="status[{{ $student->id }}]" value="A">
                    </td>

                    <td class="text-center">
                        <input type="radio" name="status[{{ $student->id }}]" value="L">
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <button class="btn btn-success">

            Save Attendance

        </button>

    </form>

    @else

    <div class="alert alert-warning text-center mt-3">

        <strong>No Record Found!</strong><br>

        No students are available for the selected Department and Subject.

    </div>

    @endif

    @endif





</div>

@endsection
@extends('layout')

@section('title', 'Edit Attendance')

@section('content')

    <div class="container-fluid mt-3">

        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="table table-bordered">

                <tr>

                    <th width="200">Department</th>

                    <td>

                        <select name="department_id" class="form-select" required>

                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ $attendance->department_id == $department->id ? 'selected' : '' }}>

                                    {{ $department->name }}

                                </option>
                            @endforeach

                        </select>

                    </td>

                </tr>

                <tr>

                    <th>Subject</th>

                    <td>

                        <select name="subject_id" class="form-select" required>

                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ $attendance->subject_id == $subject->id ? 'selected' : '' }}>

                                    {{ $subject->name }}

                                </option>
                            @endforeach

                        </select>

                    </td>

                </tr>

                <tr>

                    <th>Attendance Date</th>

                    <td>

                        <input type="date" name="attendance_date" class="form-control"
                            value="{{ $attendance->attendance_date->format('Y-m-d') }}" required>

                    </td>

                </tr>

            </table>

            <table class="table table-bordered">

                <thead class="table-dark">

                    <tr>

                        <th width="150">Roll No</th>

                        <th>Student Name</th>

                        <th width="80">P</th>

                        <th width="80">A</th>

                        <th width="80">L</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>

                            {{ $attendance->student->roll_number }}

                        </td>

                        <td>

                            {{ $attendance->student->name }}

                        </td>

                        <td class="text-center">

                            <input type="radio" name="status" value="P"
                                {{ $attendance->status == 'P' ? 'checked' : '' }}>

                        </td>

                        <td class="text-center">

                            <input type="radio" name="status" value="A"
                                {{ $attendance->status == 'A' ? 'checked' : '' }}>

                        </td>

                        <td class="text-center">

                            <input type="radio" name="status" value="L"
                                {{ $attendance->status == 'L' ? 'checked' : '' }}>

                        </td>

                    </tr>

                </tbody>

            </table>

            <input type="hidden" name="student_id" value="{{ $attendance->student_id }}">

            <button class="btn btn-success">

                Update Attendance

            </button>

            <a href="{{ route('attendances.index') }}" class="btn btn-secondary">

                Back

            </a>

        </form>

    </div>

@endsection

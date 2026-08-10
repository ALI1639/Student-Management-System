@extends('layout')

@section('title', 'Attendance List')

@section('content')

    <div class="container-fluid mt-3">

        <div class=" mb-3">
            @can('create', App\Models\Attendance::class)
                <a href="{{ route('attendances.create') }}" class="btn btn-primary">
                    Take Attendance
                </a>
            @endcan
        </div>


        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif
        <div class="table-responsive">

            <table class="table table-hover table-bordered table-striped align-middle mb-0">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>Roll No</th>
                        <th>Student Name</th>
                        <th>Department</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($attendances as $attendance)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $attendance->student->roll_number }}</td>

                            <td>{{ $attendance->student->name }}</td>

                            <td>{{ $attendance->subject->name }}</td>

                            <td>{{ $attendance->department->name }}</td>

                            <td>{{ $attendance->attendance_date->format('d-m-Y') }}</td>

                            <td>
                                @if ($attendance->status == 'P')
                                    <span class="badge bg-success">Present</span>
                                @elseif($attendance->status == 'A')
                                    <span class="badge bg-danger">Absent</span>
                                @else
                                    <span class="badge bg-warning text-dark">Leave</span>
                                @endif

                            </td>

                            <td class="text-nowrap">

                                @can('update', $attendance)
                                    <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan

                                @can('delete', $attendance)
                                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete Attendance?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center">

                                No Attendance Found

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>
            <div class="mt-3">
                {{ $attendances->links('pagination::bootstrap-5') }}
            </div>

        </div>
    @endsection

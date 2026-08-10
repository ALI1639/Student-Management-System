@extends('layout')

@section('title', 'Recent Activity')

@section('content')

    <div class="container-fluid">

        <div class="card shadow-sm">

            <div class="card-header bg-white d-flex justify-content-between align-items-center">

                <form action="{{ route('destroy.activities') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete all records?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete All</button>
                </form>

            </div>

            <div class="card-body">

                <form method="GET" class="row mb-3">

                    <div class="col-md-4">

                        <select name="module" class="form-select">

                            <option value="">All Modules</option>

                            <option value="Student" {{ request('module') == 'Student' ? 'selected' : '' }}>
                                Student
                            </option>

                            <option value="Teacher" {{ request('module') == 'Teacher' ? 'selected' : '' }}>
                                Teacher
                            </option>

                            <option value="Department" {{ request('module') == 'Department' ? 'selected' : '' }}>
                                Department
                            </option>

                            <option value="Course" {{ request('module') == 'Course' ? 'selected' : '' }}>
                                Course
                            </option>

                            <option value="Subject" {{ request('module') == 'Subject' ? 'selected' : '' }}>
                                Subject
                            </option>

                            <option value="Results" {{ request('module') == 'Result' ? 'selected' : '' }}>
                                Result
                            </option>

                            <option value="Attendance" {{ request('module') == 'Attendance' ? 'selected' : '' }}>
                                Attendance
                            </option>

                        </select>

                    </div>

                    <div class="col-md-4">

                        <select name="action" class="form-select">

                            <option value="">All Actions</option>

                            <option value="Created" {{ request('action') == 'Created' ? 'selected' : '' }}>
                                Created
                            </option>

                            <option value="Updated" {{ request('action') == 'Updated' ? 'selected' : '' }}>
                                Updated
                            </option>

                            <option value="Deleted" {{ request('action') == 'Deleted' ? 'selected' : '' }}>
                                Deleted
                            </option>

                            <option value="Submitted" {{ request('action') == 'Submitted' ? 'selected' : '' }}>
                                Submitted
                            </option>
                            <option value="Published" {{ request('action') == 'Published' ? 'selected' : '' }}>
                                Published
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary w-100">

                            <i class="fas fa-filter"></i>

                            Filter

                        </button>

                    </div>

                    <div class="col-md-2">

                        <a href="{{ route('activities.index') }}" class="btn btn-secondary w-100">

                            Reset

                        </a>

                    </div>

                </form>

                <div class="table-responsive">

                    <table class="table table-hover table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>User</th>

                                <th>Module</th>

                                <th>Action</th>

                                <th>Description</th>

                                <th>Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($activities as $activity)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        {{ $activity->user->name ?? 'System' }}

                                    </td>

                                    <td>

                                        {{ $activity->module }}

                                    </td>

                                    <td>

                                        @if ($activity->action == 'Created')
                                            <span class="badge bg-success">
                                                Created
                                            </span>
                                        @elseif($activity->action == 'Updated')
                                            <span class="badge bg-warning">
                                                Updated
                                            </span>
                                        @elseif($activity->action == 'Deleted')
                                            <span class="badge bg-danger">
                                                Deleted
                                            </span>
                                        @elseif($activity->action == 'Submitted')
                                            <span class="badge bg-primary">
                                                Submitted
                                            </span>
                                        @elseif($activity->action == 'Published')
                                            <span class="badge bg-dark">
                                                Published
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $activity->description }}

                                    </td>

                                    <td>

                                        {{ $activity->created_at->format('d M Y') }}

                                        <br>

                                        <small class="text-muted">

                                            {{ $activity->created_at->diffForHumans() }}

                                        </small>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center">

                                        No Activity Found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    {{ $activities->links('pagination::bootstrap-5') }}

                </div>

            </div>

        </div>

    </div>

@endsection

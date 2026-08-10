@extends('layout')

@section('title')
    Students
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">

        @can('create', App\Models\Student::class)
            <a href="{{ route('students.create') }}" class="btn btn-success btn-sm mb-3">Add New</a>
        @endcan
        {{-- <form action="{{ route('users.destroyall') }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete all records?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete All</button>
    </form> --}}
    </div>

    <!-- Responsive Wrapper Added Here -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Roll Number</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Status</th>
                    {{-- <th>View</th>
                <th>Delete</th>
                <th>Update</th> --}}
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->roll_number }}</td>
                        <td>{{ $s->name }}</td>
                        <td>{{ $s->phone }}</td>
                        <td>{{ $s->department->name }}</td>
                        <td>
                            @if ($s->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>


                        <td class="text-nowrap">
                            @can('view', $s)
                                <a href="{{ route('students.show', $s->id) }}" class="btn btn-sm btn-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                            @endcan


                            @can('update', $s)
                                <a href="{{ route('students.edit', $s->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            @endcan


                            @can('delete', $s)
                                <form action="{{ route('students.destroy', $s->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@extends('layout')

@section('title')
    Courses
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">

        @can('create', App\Models\Course::class)
            <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm mb-3">Add New</a>
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
                    <th>Course</th>
                    <th>Code</th>
                    <th>Credit Hours</th>
                    <th>Semester</th>
                    <th>Department</th>
                    <th>Status</th>
                    {{-- <th>View</th>
                <th>Delete</th>
                <th>Update</th> --}}
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->code }}</td>
                        <td>{{ $c->credit_hours }}</td>
                        <td>{{ $c->semester }}</td>
                        <td>{{ $c->department->name }}</td>
                        <td>
                            @if ($c->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        {{-- <td><a href="{{ route('courses.show',$c->id)}}" class="btn btn-primary btn-sm">View</a></td>
                <td>
                    <form action="{{ route('courses.destroy',$c->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
                <td><a href="{{ route('courses.edit',$c->id) }}" class="btn btn-warning btn-sm">Update</a></td> --}}

                        <td class="text-nowrap">
                            <a href="{{ route('courses.show', $c->id) }}" class="btn btn-sm btn-primary" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            @can('update', $c)
                                <a href="{{ route('courses.edit', $c->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            @endcan

                            @can('delete', $c)
                                <form action="{{ route('courses.destroy', $c->id) }}" method="POST" class="d-inline"
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
            {{ $courses->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

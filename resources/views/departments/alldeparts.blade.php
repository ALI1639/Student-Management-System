@extends('layout')

@section('title')
    Departments
@endsection

@section('content')
    <div class="d-flex justify-center-between align-items-center mb-3 flex-wrap gap-2">
        @can('create', App\Models\Department::class)
            <a href="{{ route('departments.create') }}" class="btn btn-success btn-sm mb-3">Add New</a>
        @endcan

        {{-- <form action="{{ route('destroyall') }}" method="POST"
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
                    <th>Department Name</th>
                    <th>Code</th>
                    <th>Status</th>
                    {{-- <th>View</th>
                <th>Delete</th>
                <th>Update</th> --}}
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($depart as $d)
                    <tr>
                        <td>{{ $d->id }}</td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->code }}</td>
                        <td>
                            @if ($d->status)
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

                        <td class="text-nowrap text-center">
                            <a href="{{ route('departments.show', $d->id) }}" class="btn btn-sm btn-primary" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            @can('update', $d)
                                <a href="{{ route('departments.edit', $d->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            @endcan

                            <form action="{{ route('departments.destroy', $d->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure?')">

                                @csrf
                                @method('DELETE')

                                @can('delete', $d)
                                    <button class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $depart->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

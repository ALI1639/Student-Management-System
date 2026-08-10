@extends('layout')

@section('title')
    Teachers
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">

        @can('create', App\Models\Teacher::class)
            <a href="{{ route('teachers.create') }}" class="btn btn-success btn-sm mb-3">Add New</a>
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
                    <th>ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Qulification</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->name }}</td>
                        <td>{{ $t->qualification }}</td>
                        <td>{{ $t->department->name }}</td>

                        <td>
                            @if ($t->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>


                        <td class="text-nowrap text-center">

                            <div class="d-flex gap-1 justify-content-center">
                                @can('view', $t)
                                    <a href="{{ route('teachers.show', $t->id) }}" class="btn btn-sm btn-primary"
                                        title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                @endcan


                                @can('update', $t)
                                    <a href="{{ route('teachers.edit', $t->id) }}" class="btn btn-sm btn-warning"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan


                                @can('delete', $t)
                                    <form action="{{ route('teachers.destroy', $t->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $teachers->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

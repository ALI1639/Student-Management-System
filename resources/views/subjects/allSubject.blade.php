@extends('layout')

@section('title')
    Subjects
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">

        @can('create', App\Models\Subject::class)
            <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm mb-3">Add New</a>
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
                    <th class="text-center">Subject Name</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Teacher Name</th>
                    <th class="text-center">Department Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $s)
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->code }}</td>
                    <td>
                        @foreach ($s->teachers as $teacher)
                            {{ $teacher->name }}<br>
                        @endforeach
                    </td>
                    <td>{{ $s->department->name }}</td>

                    <td>
                        @if ($s->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>


                    <td class="text-nowrap text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            @can('view', $s)
                                <a href="{{ route('subjects.show', $s->id) }}" class="btn btn-sm btn-primary" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                            @endcan

                            @can('update', $s)
                                <a href="{{ route('subjects.edit', $s->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            @endcan


                            @can('delete', $s)
                                <form action="{{ route('subjects.destroy', $s->id) }}" method="POST" class="d-inline"
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
            {{ $subjects->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

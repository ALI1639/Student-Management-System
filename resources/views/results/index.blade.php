@extends('layout')

@section('title', 'Results')

@section('content')

    <div class="container-fluid mt-4">

        <div class="card shadow">

            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    <i class="bi bi-journal-check"></i> Student Results
                </h4>

                @can('create', App\Models\Result::class)
                    <a href="{{ route('results.create') }}" class="btn btn-light">
                        <i class="bi bi-plus-circle"></i> Add Result
                    </a>
                @endcan



            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">

                        {{ session('success') }}

                        <button class="btn-close" data-bs-dismiss="alert"></button>

                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle text-center">

                        <thead class="table-dark">

                            <tr>

                                <th>#</th>

                                <th>Roll No</th>

                                <th>Student</th>

                                <th>Subject</th>

                                <th>Total</th>

                                <th>Obtained</th>

                                <th>%</th>

                                <th>Grade</th>

                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($results as $result)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $result->student->roll_number }}</td>

                                    <td>{{ $result->student->name }}</td>

                                    <td>{{ $result->subject->name }}</td>

                                    <td>{{ $result->total_marks }}</td>

                                    <td>{{ $result->obtained_marks }}</td>

                                    <td>{{ number_format($result->percentage, 2) }}%</td>

                                    <td>

                                        @if ($result->grade == 'A+')
                                            <span class="badge bg-success">A+</span>
                                        @elseif($result->grade == 'A')
                                            <span class="badge bg-primary">A</span>
                                        @elseif($result->grade == 'B')
                                            <span class="badge bg-info">B</span>
                                        @elseif($result->grade == 'C')
                                            <span class="badge bg-warning text-dark">C</span>
                                        @elseif($result->grade == 'D')
                                            <span class="badge bg-secondary">D</span>
                                        @else
                                            <span class="badge bg-danger">F</span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($result->status == 'Pass')
                                            <span class="badge bg-success">
                                                Pass
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Fail
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('results.show', $result->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        @can('update', $result)
                                            <a href="{{ route('results.edit', $result->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan


                                        @can('delete', $result)
                                            <form action="{{ route('results.destroy', $result->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Delete this Result?')"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="10" class="text-center text-danger">

                                        No Results Found.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $results->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>

    </div>

@endsection

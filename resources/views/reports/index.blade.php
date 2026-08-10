@extends('layout')

@section('title')
    Reports
@endsection


@section('content')
    @can('viewReport', App\Models\Report::class)
        <div class="container-fluid">


            <div class="d-flex justify-content-between align-items-center mb-4">


                <h3 class="mb-0">

                    <i class="bi bi-file-earmark-bar-graph text-primary"></i>

                    Reports

                </h3>



                <div>


                    <a href="{{ route('reports.pdf') }}" class="btn btn-danger">

                        <i class="bi bi-file-pdf"></i>
                        PDF

                    </a>



                    <a href="{{ route('reports.excel') }}" class="btn btn-success">

                        <i class="bi bi-file-earmark-excel"></i>
                        Excel

                    </a>



                    <a href="{{ route('reports.print') }}" target="_blank" class="btn btn-primary">

                        <i class="bi bi-printer"></i>
                        Print

                    </a>


                </div>


            </div>





            {{-- Student Report --}}


            <div class="card shadow border-0 mb-4">


                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        <i class="bi bi-people text-primary"></i>

                        Student Report

                    </h5>

                </div>



                <div class="card-body table-responsive">


                    <table class="table table-bordered table-striped">


                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Name</th>
                                <th>Roll Number</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Course</th>

                            </tr>

                        </thead>



                        <tbody>


                            @foreach ($students as $student)
                                <tr>


                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    <td>
                                        {{ $student->name }}
                                    </td>


                                    <td>
                                        {{ $student->roll_number }}
                                    </td>


                                    <td>
                                        {{ $student->email }}
                                    </td>


                                    <td>
                                        {{ $student->department->name ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $student->course->name ?? '-' }}
                                    </td>


                                </tr>
                            @endforeach


                        </tbody>


                    </table>


                </div>

            </div>







            {{-- Teacher Report --}}


            <div class="card shadow border-0 mb-4">


                <div class="card-header bg-white">


                    <h5 class="mb-0">

                        <i class="bi bi-person-workspace text-success"></i>

                        Teacher Report

                    </h5>


                </div>




                <div class="card-body table-responsive">


                    <table class="table table-bordered table-striped">


                        <thead>


                            <tr>

                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>

                            </tr>


                        </thead>



                        <tbody>


                            @foreach ($teachers as $teacher)
                                <tr>


                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    <td>
                                        {{ $teacher->name }}
                                    </td>


                                    <td>
                                        {{ $teacher->email }}
                                    </td>


                                    <td>
                                        {{ $teacher->phone }}
                                    </td>


                                    <td>
                                        {{ $teacher->department->name ?? '-' }}
                                    </td>


                                </tr>
                            @endforeach


                        </tbody>


                    </table>


                </div>


            </div>







            {{-- Result Report --}}


            <div class="card shadow border-0 mb-4">


                <div class="card-header bg-white">


                    <h5 class="mb-0">

                        <i class="bi bi-bar-chart text-warning"></i>

                        Result Report

                    </h5>


                </div>




                <div class="card-body table-responsive">


                    <table class="table table-bordered table-striped">


                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Total Marks</th>
                                <th>Obtained Marks</th>
                                <th>Percentage</th>
                                <th>Grade</th>
                                <th>Status</th>

                            </tr>

                        </thead>




                        <tbody>


                            @foreach ($results as $result)
                                <tr>


                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    <td>
                                        {{ $result->student->name ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $result->subject->name ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $result->total_marks }}
                                    </td>


                                    <td>
                                        {{ $result->obtained_marks }}
                                    </td>


                                    <td>
                                        {{ $result->percentage }}%
                                    </td>


                                    <td>
                                        {{ $result->grade }}
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


                                </tr>
                            @endforeach


                        </tbody>


                    </table>


                </div>


            </div>







            {{-- Attendance Report --}}


            <div class="card shadow border-0 mb-4">


                <div class="card-header bg-white">


                    <h5 class="mb-0">

                        <i class="bi bi-calendar-check text-danger"></i>

                        Attendance Report

                    </h5>


                </div>





                <div class="card-body table-responsive">


                    <table class="table table-bordered table-striped">


                        <thead>


                            <tr>

                                <th>#</th>
                                <th>Student</th>
                                <th>Date</th>
                                <th>Status</th>

                            </tr>


                        </thead>



                        <tbody>


                            @foreach ($attendance as $att)
                                <tr>


                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    <td>
                                        {{ $att->student->name ?? '-' }}
                                    </td>


                                    <td>
                                        {{ $att->attendance_date->format('d M Y') }}
                                    </td>


                                    <td>


                                        @if ($att->status == 'P')
                                            <span class="badge bg-success">Present</span>
                                        @elseif($att->status == 'A')
                                            <span class="badge bg-danger">Absent</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Leave</span>
                                        @endif


                                    </td>


                                </tr>
                            @endforeach


                        </tbody>


                    </table>


                </div>


            </div>



        </div>
    @endcan
@endsection

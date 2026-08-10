@extends('layout')

@section('title','Result Detail')


@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white d-flex justify-content-between">

            <h4 class="mb-0">
                Student Marksheet
            </h4>

            <a href="{{ route('results.index') }}" class="btn btn-light btn-sm">
                Back
            </a>


        </div>



        <div class="card-body">



            <!-- Student Information -->


            <div class="row mb-4">


                <div class="col-md-6">

                    <h5>
                        Student Information
                    </h5>


                    <p>
                        <strong>Name:</strong>
                        {{ $result->student->name }}
                    </p>


                    <p>
                        <strong>Roll Number:</strong>
                        {{ $result->student->roll_number }}
                    </p>


                    <p>
                        <strong>Department:</strong>
                        {{ $result->student->department->name ?? 'N/A' }}
                    </p>


                    <p>
                        <strong>Course:</strong>
                        {{ $result->student->course->name ?? 'N/A' }}
                    </p>


                </div>



                <div class="col-md-6">


                    <h5>
                        Result Information
                    </h5>


                    <p>
                        <strong>Subject:</strong>
                        {{ $result->subject->name }}
                    </p>


                    <p>
                        <strong>Total Marks:</strong>
                        {{ $result->total_marks }}
                    </p>


                    <p>
                        <strong>Obtained Marks:</strong>
                        {{ $result->obtained_marks }}
                    </p>


                    <p>
                        <strong>Date:</strong>
                        {{ $result->created_at->format('d-m-Y') }}
                    </p>



                </div>


            </div>





            <!-- Result Table -->


            <table class="table table-bordered text-center">


                <thead class="table-dark">


                    <tr>

                        <th>Total Marks</th>

                        <th>Obtained Marks</th>

                        <th>Percentage</th>

                        <th>Grade</th>

                        <th>Status</th>

                    </tr>


                </thead>



                <tbody>


                    <tr>


                        <td>
                            {{ $result->total_marks }}
                        </td>


                        <td>
                            {{ $result->obtained_marks }}
                        </td>


                        <td>
                            {{ number_format($result->percentage,2) }}%
                        </td>


                        <td>


                            @if($result->grade == 'A+')


                            <span class="badge bg-success">
                                A+
                            </span>


                            @elseif($result->grade == 'A')


                            <span class="badge bg-primary">
                                A
                            </span>


                            @elseif($result->grade == 'B')


                            <span class="badge bg-info">
                                B
                            </span>


                            @elseif($result->grade == 'C')


                            <span class="badge bg-warning text-dark">
                                C
                            </span>


                            @elseif($result->grade == 'D')


                            <span class="badge bg-secondary">
                                D
                            </span>


                            @else


                            <span class="badge bg-danger">
                                F
                            </span>


                            @endif


                        </td>



                        <td>


                            @if($result->status == 'Pass')


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



                </tbody>


            </table>





            {{-- <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-dark">
                    <i class="bi bi-printer"></i>
                    Print Marksheet
                </button>
            </div> --}}




        </div>


    </div>


</div>


@endsection
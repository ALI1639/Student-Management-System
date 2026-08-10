<!DOCTYPE html>

<html>

<head>

    <title>
        Student Management Report
    </title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        @media print {

            .btn-print {
                display: none;
            }

        }
    </style>


</head>


<body>


    <div class="container mt-4">


        <button onclick="window.print()" class="btn btn-primary btn-print mb-3">

            <i class="bi bi-printer"></i>

            Print

        </button>



        <h2 class="text-center mb-4">

            Student Management System Report

        </h2>





        {{-- Student Report --}}


        <h4>
            Student Report
        </h4>


        <table class="table table-bordered">


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







        {{-- Teacher Report --}}


        <h4 class="mt-4">
            Teacher Report
        </h4>



        <table class="table table-bordered">


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








        {{-- Result Report --}}


        <h4 class="mt-4">
            Result Report
        </h4>



        <table class="table table-bordered">


            <thead>


                <tr>

                    <th>#</th>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Total</th>
                    <th>Obtained</th>
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
                            {{ $result->status }}
                        </td>


                    </tr>
                @endforeach


            </tbody>


        </table>








        {{-- Attendance Report --}}


        <h4 class="mt-4">
            Attendance Report
        </h4>



        <table class="table table-bordered">


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
                            {{ $att->attendance_date->format('d M Y') ?? '-' }}
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



    <script>
        window.onload = function() {

            window.print();

        }
    </script>



</body>

</html>

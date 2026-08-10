<!DOCTYPE html>
<html>

<head>

    <title>
        Student Management Report
    </title>


    <style>
        body {

            font-family: Arial, sans-serif;

        }


        h2,
        h3 {

            text-align: center;

        }


        table {

            width: 100%;

            border-collapse: collapse;

            margin-bottom: 20px;

        }


        th,
        td {

            border: 1px solid #000;

            padding: 6px;

            font-size: 12px;

        }


        th {

            background: #eee;

        }
    </style>


</head>


<body>


    <h2>
        Student Management System Report
    </h2>


    <hr>



    <h3>
        Student Report
    </h3>


    <table>


        <tr>

            <th>#</th>
            <th>Name</th>
            <th>Roll Number</th>
            <th>Email</th>
            <th>Department</th>
            <th>Course</th>

        </tr>



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


    </table>







    <h3>
        Teacher Report
    </h3>


    <table>


        <tr>

            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Department</th>

        </tr>




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



    </table>







    <h3>
        Result Report
    </h3>


    <table>


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



    </table>








    <h3>
        Attendance Report
    </h3>


    <table>


        <tr>

            <th>#</th>
            <th>Student</th>
            <th>Date</th>
            <th>Status</th>

        </tr>




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



    </table>



</body>

</html>

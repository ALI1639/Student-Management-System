<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Result;
use App\Models\Attendance;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ReportExport implements FromCollection, WithHeadings
{


    public function collection()
    {
        $data = collect();
        // Students

        $students = Student::with([
            'department',
            'course'
        ])
            ->orderBy('id', 'desc')
            ->get();



        foreach ($students as $student) {

            $data->push([

                'Type' => 'Student',

                'Name' => $student->name,

                'Roll Number' => $student->roll_number,

                'Email' => $student->email,

                'Department' =>
                $student->department->name ?? '-',

                'Course' =>
                $student->course->name ?? '-',

                'Subject' => '-',

                'Marks' => '-',

                'Grade' => '-',

                'Status' => $student->status ? 'Active' : 'Inactive',

                'Date' => '-'

            ]);
        }







        // Teachers

        $teachers = Teacher::with([
            'department'
        ])
            ->orderBy('id', 'desc')
            ->get();



        foreach ($teachers as $teacher) {

            $data->push([

                'Type' => 'Teacher',

                'Name' => $teacher->name,

                'Roll Number' => '-',

                'Email' => $teacher->email,

                'Department' =>
                $teacher->department->name ?? '-',

                'Course' => '-',

                'Subject' => '-',

                'Marks' => '-',

                'Grade' => '-',

                'Status' => '-',

                'Date' => '-'

            ]);
        }







        // Results

        $results = Result::with([
            'student',
            'subject'
        ])
            ->orderBy('id', 'desc')
            ->get();



        foreach ($results as $result) {

            $data->push([

                'Type' => 'Result',

                'Name' =>
                $result->student->name ?? '-',

                'Roll Number' =>
                $result->student->roll_number ?? '-',

                'Email' =>
                $result->student->email ?? '-',

                'Department' => '-',

                'Course' => '-',

                'Subject' =>
                $result->subject->name ?? '-',

                'Marks' =>
                $result->obtained_marks .
                    '/' .
                    $result->total_marks,

                'Grade' =>
                $result->grade,

                'Status' =>
                $result->status,

                'Date' => '-'

            ]);
        }







        // Attendance

        $attendance = Attendance::with([
            'student'
        ])
            ->orderBy('id', 'desc')
            ->get();



        foreach ($attendance as $att) {

            $data->push([

                'Type' => 'Attendance',

                'Name' =>
                $att->student->name ?? '-',

                'Roll Number' =>
                $att->student->roll_number ?? '-',

                'Email' =>
                $att->student->email ?? '-',

                'Department' => '-',

                'Course' => '-',

                'Subject' => '-',

                'Marks' => '-',

                'Grade' => '-',

                'Status' =>
                $att->status,

                'Date' =>
                $att->date ?? '-'

            ]);
        }



        return $data;
    }





    public function headings(): array
    {

        return [

            'Type',
            'Name',
            'Roll Number',
            'Email',
            'Department',
            'Course',
            'Subject',
            'Marks',
            'Grade',
            'Status',
            'Date'

        ];
    }
}

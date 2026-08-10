<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Attendance;
use App\Models\Report;
use App\Models\Result;
use App\Models\Student;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{

    // Reports Page

    public function index()
    {
        $this->authorize('viewReport', Report::class);

        $students = Student::with([
            'department',
            'course'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $teachers = Teacher::with([
            'department'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $results = Result::with([
            'student',
            'subject'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $attendance = Attendance::with([
            'student'
        ])
            ->orderBy('id', 'desc')
            ->get();



        return view('reports.index', compact(

            'students',
            'teachers',
            'results',
            'attendance'

        ));
    }





    // PDF Download

    public function pdf()
    {

        $students = Student::with([
            'department',
            'course'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $teachers = Teacher::with([
            'department'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $results = Result::with([
            'student',
            'subject'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $attendance = Attendance::with([
            'student'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $pdf = Pdf::loadView(

            'reports.pdf',

            compact(

                'students',
                'teachers',
                'results',
                'attendance'

            )

        );



        return $pdf->download(
            'student-management-report.pdf'
        );
    }





    // Excel Export

    public function excel()
    {

        return Excel::download(

            new ReportExport,

            'student-management-report.xlsx'

        );
    }





    // Print Report

    public function print()
    {


        $students = Student::with([
            'department',
            'course'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $teachers = Teacher::with([
            'department'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $results = Result::with([
            'student',
            'subject'
        ])
            ->orderBy('id', 'desc')
            ->get();



        $attendance = Attendance::with([
            'student'
        ])
            ->orderBy('id', 'desc')
            ->get();



        return view(

            'reports.print',

            compact(

                'students',
                'teachers',
                'results',
                'attendance'

            )

        );
    }
}

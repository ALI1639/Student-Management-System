<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\NotificationHelper;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    /**
     * Display Attendance List
     */
    // public function index()
    // {
    //     $this->authorize('create', Attendance::class);
    //     $attendances = Attendance::with([
    //         'student',
    //         'department',
    //         'subject'
    //     ])
    //         ->orderBy('attendance_date', 'desc')
    //         ->paginate(10);

    //     return view('attendances.index', compact('attendances'));
    // }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Attendance::class);

        $attendances = Attendance::with([
            'student',
            'subject'
        ])
            ->whereHas('subject', function ($query) {
                $query->forTeacher();
            })
            ->latest('attendance_date')
            ->paginate(10)
            ->withQueryString();

        return view('attendances.index', compact('attendances'));
    }

    /**
     * Attendance Form
     */
    public function create(Request $request)
    {
        $this->authorize('create', Attendance::class);
        $departments = Department::all();

        $subjects = Subject::all();

        $students = collect();

        if (
            $request->filled('department_id') &&
            $request->filled('subject_id')
        ) {

            $students = Student::where('department_id', $request->department_id)
                ->orderBy('roll_number')
                ->get();
        }

        return view(
            'attendances.create',
            compact(
                'departments',
                'subjects',
                'students'
            )
        );
    }

    /**
     * Bulk Attendance Save
     */
    public function store(Request $request)
    {
        $this->authorize('create', Attendance::class);
        $request->validate([

            'department_id' => 'required',

            'subject_id' => 'required',

            'attendance_date' => 'required|date',

            'student_id' => 'required|array',

            'status' => 'required|array',

        ]);


        foreach ($request->student_id as $studentId) {

            Attendance::updateOrCreate(

                [

                    'student_id' => $studentId,

                    'subject_id' => $request->subject_id,

                    'attendance_date' => $request->attendance_date,

                ],

                [

                    'department_id' => $request->department_id,

                    'status' => $request->status[$studentId]

                ]

            );
        }

        ActivityHelper::log(
            'Attendance',
            'Submitted',
            'Attendance submitted successfully.'
        );

        NotificationHelper::create(
            'Attendance Marked',
            'Student attendance has been marked successfully.',
            'info',
            'fa-calendar-check',
            'success',
            route('attendances.index')
        );


        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance Saved Successfully.');
    }

    /**
     * Edit Attendance
     */
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $this->authorize('update', $attendance);

        $departments = Department::all();

        $subjects = Subject::all();

        $students = Student::where(
            'department_id',
            $attendance->department_id
        )->orderBy('roll_number')->get();

        return view(
            'attendances.edit',
            compact(
                'attendance',
                'departments',
                'subjects',
                'students'
            )
        );
    }

    /**
     * Update Attendance
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'department_id'   => 'required|exists:departments,id',

            'subject_id'      => 'required|exists:subjects,id',

            'student_id'      => 'required|exists:students,id',

            'attendance_date' => 'required|date',

            'status'          => 'required|in:P,A,L',

        ]);

        $attendance = Attendance::findOrFail($id);
        $this->authorize('update', $attendance);

        $attendance->update([

            'department_id'   => $request->department_id,

            'subject_id'      => $request->subject_id,

            'student_id'      => $request->student_id,

            'attendance_date' => $request->attendance_date,

            'status'          => $request->status,

        ]);

        ActivityHelper::log(
            'Attendance',
            'Updated',
            'Attendance has been updated.'
        );

        NotificationHelper::create(
            'Attendance Updated',
            'Student attendance has been updated successfully.',
            'info',
            'fa-calendar-alt',
            'warning',
            route('attendances.index')
        );

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance Updated Successfully.');
    }

    /**
     * Delete Attendance
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $this->authorize('delete', $attendance);
        $attendance->delete();


        ActivityHelper::log(
            'Attendance',
            'Deleted',
            'Attendance record has been deleted.'
        );


        NotificationHelper::create(
            'Attendance Deleted',
            'Attendance record has been deleted successfully.',
            'info',
            'fa-trash',
            'danger',
            route('attendances.index')
        );

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance Deleted Successfully.');
    }
}

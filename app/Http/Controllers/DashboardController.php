<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Department;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // ==============================
        // Dashboard Counts
        // ==============================

        $students = Student::count();
        $teachers = Teacher::count();
        $departments = Department::count();
        $courses = Course::count();
        $subjects = Subject::count();
        $results = Result::count();
        $attendance = Attendance::count();

        // ==============================
        // Active / Inactive Students
        // ==============================

        $activeStudents = Student::where('status', 1)->count();
        $inactiveStudents = Student::where('status', 0)->count();

        // ==============================
        // Attendance Summary
        // ==============================

        $present = Attendance::forStudent()
            ->where('status', 'P')
            ->count();

        $absent = Attendance::forStudent()
            ->where('status', 'A')
            ->count();

        $late = Attendance::forStudent()
            ->where('status', 'L')
            ->count();

        // ==============================
        // Weekly Attendance Chart
        // ==============================

        $attendanceChart = [];

        $startOfWeek = Carbon::now()->startOfWeek(); // Monday

        for ($i = 0; $i < 6; $i++) {

            $date = $startOfWeek->copy()->addDays($i);

            $attendanceChart[] = Attendance::forStudent()
                ->whereDate('attendance_date', $date)
                ->where('status', 'P')
                ->count();
        }

        // ==============================
        // Today's Attendance
        // ==============================

        $presentToday = Attendance::forStudent()
            ->whereDate('attendance_date', today())
            ->where('status', 'P')
            ->count();

        $absentToday = Attendance::forStudent()
            ->whereDate('attendance_date', today())
            ->where('status', 'A')
            ->count();
        // ==============================
        // Result Summary
        // ==============================

        $passStudents = Result::where('status', 'Pass')->count();
        $failStudents = Result::where('status', 'Fail')->count();

        // ==============================
        // Recent Students
        // ==============================

        $recentStudents = Student::with(['department', 'course'])
            ->latest('id')
            ->take(5)
            ->get();

        // ==============================
        // Recent Teachers
        // ==============================

        $recentTeachers = Teacher::with('department')
            ->latest('id')
            ->take(5)
            ->get();

        // ==============================
        // Recent Results
        // ==============================

        $recentResults = Result::with(['student', 'subject'])
            ->latest('id')
            ->take(5)
            ->get();

        // ==============================
        // Recent Attendance
        // ==============================

        $recentAttendance = Attendance::with(['student', 'subject'])
            ->forStudent()
            ->latest('id')
            ->take(5)
            ->get();


        $recentActivities = Activity::with('user')
            ->latest()
            ->take(6)
            ->get();

        // ==============================
        // Subject List
        // ==============================

        $subjectList = Subject::latest('id')
            ->take(6)
            ->get();

        // ==============================
        // Top Students
        // ==============================

        $topStudents = Student::latest('id')
            ->take(5)
            ->get();

        // ==============================
        // Top Teachers
        // ==============================

        $topTeachers = Teacher::with('department')
            ->latest('id')
            ->take(5)
            ->get();

        // ==============================
        // Teacher Subject Attendance
        // ==============================

        $teacherSubjectAttendance = collect();

        $teacherTotalPresent = 0;
        $teacherTotalAbsent = 0;

        if (Auth::user()->role === 'Teacher') {

            $teacher = Teacher::where(
                'email',
                Auth::user()->email
            )->first();

            if ($teacher) {

                // Sirf is teacher ke assigned subjects
                $teacherSubjects = $teacher->subjects()
                    ->with('attendances')
                    ->get();

                $teacherSubjectAttendance = $teacherSubjects->map(
                    function ($subject) {

                        $total = $subject->attendances->count();

                        $present = $subject->attendances
                            ->where('status', 'P')
                            ->count();

                        $absent = $subject->attendances
                            ->where('status', 'A')
                            ->count();

                        $percentage = $total > 0
                            ? round(($present / $total) * 100, 1)
                            : 0;

                        return [
                            'subject' => $subject->name,
                            'present' => $present,
                            'absent' => $absent,
                            'total' => $total,
                            'percentage' => $percentage,
                        ];
                    }
                );

                $teacherTotalPresent =
                    $teacherSubjectAttendance->sum('present');

                $teacherTotalAbsent =
                    $teacherSubjectAttendance->sum('absent');
            }
        }

        // ==============================
        // Shared Data
        // ==============================

        $data = compact(
            'students',
            'teachers',
            'departments',
            'courses',
            'subjects',
            'results',
            'attendance',

            'activeStudents',
            'inactiveStudents',

            'present',
            'absent',
            'late',
            'attendanceChart',

            'presentToday',
            'absentToday',

            'passStudents',
            'failStudents',

            'recentStudents',
            'recentTeachers',
            'recentResults',
            'recentAttendance',
            'recentActivities',

            'topStudents',
            'topTeachers',

            'subjectList',

            'teacherSubjectAttendance',
            'teacherTotalPresent',
            'teacherTotalAbsent',



        );

        // ==============================
        // Role Based Dashboard
        // ==============================

        switch (Auth::user()->role) {

            case 'Admin':
                return view('dashboard.admin', $data);

            case 'Teacher':
                return view('dashboard.teacher', $data);

            case 'Student':
                return view('dashboard.student', $data);

            default:
                abort(403, 'Unauthorized');
        }
    }
}

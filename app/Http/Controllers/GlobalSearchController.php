<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\Course;
use App\Models\Subject;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $search = trim($request->search);

        if ($search == '') {
            return response()->json([
                'status' => false
            ]);
        }

        // ============================
        // Students
        // ============================

        $student = Student::where('name', 'like', "%{$search}%")
            ->orWhere('roll_number', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->first();

        if ($student) {

            return response()->json([
                'status' => true,
                'url' => route('students.index', [
                    'search' => $search
                ])
            ]);
        }

        // ============================
        // Teachers
        // ============================

        $teacher = Teacher::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->first();

        if ($teacher) {

            return response()->json([
                'status' => true,
                'url' => route('teachers.index', [
                    'search' => $search
                ])
            ]);
        }

        // ============================
        // Departments
        // ============================

        $department = Department::where('name', 'like', "%{$search}%")
            ->orWhere('code', 'like', "%{$search}%")
            ->first();

        if ($department) {

            return response()->json([
                'status' => true,
                'url' => route('departments.index', [
                    'search' => $search
                ])
            ]);
        }

        // ============================
        // Courses
        // ============================

        $course = Course::where('name', 'like', "%{$search}%")
            ->orWhere('code', 'like', "%{$search}%")
            ->first();

        if ($course) {

            return response()->json([
                'status' => true,
                'url' => route('courses.index', [
                    'search' => $search
                ])
            ]);
        }

        // ============================
        // Subjects
        // ============================

        $subject = Subject::where('name', 'like', "%{$search}%")
            ->orWhere('code', 'like', "%{$search}%")
            ->first();

        if ($subject) {

            return response()->json([
                'status' => true,
                'url' => route('subjects.index', [
                    'search' => $search
                ])
            ]);
        }

        // ============================
        // No Record
        // ============================

        return response()->json([
            'status' => false
        ]);
    }
}

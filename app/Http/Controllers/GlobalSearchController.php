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

        // Students
        if (Student::search($search)->exists()) {
            return response()->json([
                'status' => true,
                'url' => route('students.index', [
                    'search' => $search
                ])
            ]);
        }

        // Teachers
        if (Teacher::search($search)->exists()) {
            return response()->json([
                'status' => true,
                'url' => route('teachers.index', [
                    'search' => $search
                ])
            ]);
        }

        // Departments
        if (Department::search($search)->exists()) {
            return response()->json([
                'status' => true,
                'url' => route('departments.index', [
                    'search' => $search
                ])
            ]);
        }

        // Courses
        if (Course::search($search)->exists()) {
            return response()->json([
                'status' => true,
                'url' => route('courses.index', [
                    'search' => $search
                ])
            ]);
        }

        // Subjects
        if (Subject::search($search)->exists()) {
            return response()->json([
                'status' => true,
                'url' => route('subjects.index', [
                    'search' => $search
                ])
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }
}

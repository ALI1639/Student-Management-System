<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\NotificationHelper;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ResultController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Result::class);

        $results = Result::with(['student', 'subject'])
            ->forStudent()
            ->whereHas('subject', function ($query) {
                $query->forTeacher();
            })
            ->latest()
            ->paginate(10);

        return view('results.index', compact('results'));
    }

    // Show create form
    public function create()
    {
        $this->authorize('create', Result::class);

        $students = Student::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();

        return view('results.form', compact('students', 'subjects'));
    }

    // Store result
    public function store(Request $request)
    {
        $this->authorize('create', Result::class);

        $request->validate([
            'student_id'      => 'required|exists:students,id',
            'subject_id'      => 'required|exists:subjects,id',
            'total_marks'     => 'required|numeric|min:1',
            'obtained_marks'  => 'required|numeric|min:0',
        ]);

        if ($request->obtained_marks > $request->total_marks) {
            return back()
                ->withInput()
                ->withErrors([
                    'obtained_marks' => 'Obtained marks cannot be greater than total marks.'
                ]);
        }

        $percentage = ($request->obtained_marks / $request->total_marks) * 100;

        if ($percentage >= 80) {
            $grade = 'A+';
        } elseif ($percentage >= 70) {
            $grade = 'A';
        } elseif ($percentage >= 60) {
            $grade = 'B';
        } elseif ($percentage >= 50) {
            $grade = 'C';
        } elseif ($percentage >= 40) {
            $grade = 'D';
        } else {
            $grade = 'F';
        }

        $status = $percentage >= 40 ? 'Pass' : 'Fail';

        Result::create([
            'student_id'      => $request->student_id,
            'subject_id'      => $request->subject_id,
            'total_marks'     => $request->total_marks,
            'obtained_marks'  => $request->obtained_marks,
            'percentage'      => round($percentage, 2),
            'grade'           => $grade,
            'status'          => $status,
        ]);

        ActivityHelper::log(
            'Result',
            'Published',
            'Result has been published.'
        );

        NotificationHelper::create(
            'Result Added',
            'Student result has been added successfully.',
            'info',
            'fa-graduation-cap',
            'success',
            route('results.index')
        );

        return redirect()
            ->route('results.index')
            ->with('success', 'Result added successfully.');
    }

    // View single result
    public function show(Result $result)
    {
        $this->authorize('view', $result);

        $result->load(['student', 'subject']);

        return view('results.show', compact('result'));
    }

    // Show edit form
    public function edit(Result $result)
    {
        $this->authorize('update', $result);

        $students = Student::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();

        return view('results.form', compact('result', 'students', 'subjects'));
    }

    // Update result
    public function update(Request $request, Result $result)
    {
        $this->authorize('update', $result);

        $request->validate([
            'student_id'      => 'required|exists:students,id',
            'subject_id'      => 'required|exists:subjects,id',
            'total_marks'     => 'required|numeric|min:1',
            'obtained_marks'  => 'required|numeric|min:0',
        ]);

        if ($request->obtained_marks > $request->total_marks) {
            return back()
                ->withInput()
                ->withErrors([
                    'obtained_marks' => 'Obtained marks cannot be greater than total marks.'
                ]);
        }

        $percentage = ($request->obtained_marks / $request->total_marks) * 100;

        if ($percentage >= 80) {
            $grade = 'A+';
        } elseif ($percentage >= 70) {
            $grade = 'A';
        } elseif ($percentage >= 60) {
            $grade = 'B';
        } elseif ($percentage >= 50) {
            $grade = 'C';
        } elseif ($percentage >= 40) {
            $grade = 'D';
        } else {
            $grade = 'F';
        }

        $status = $percentage >= 40 ? 'Pass' : 'Fail';

        $result->update([
            'student_id'      => $request->student_id,
            'subject_id'      => $request->subject_id,
            'total_marks'     => $request->total_marks,
            'obtained_marks'  => $request->obtained_marks,
            'percentage'      => round($percentage, 2),
            'grade'           => $grade,
            'status'          => $status,
        ]);

        ActivityHelper::log(
            'Result',
            'Updated',
            'Result has been updated.'
        );

        NotificationHelper::create(
            'Result Updated',
            'Student result has been updated successfully.',
            'info',
            'fa-edit',
            'warning',
            route('results.index')
        );

        return redirect()
            ->route('results.index')
            ->with('success', 'Result updated successfully.');
    }

    // Delete result
    public function destroy(Result $result)
    {
        $this->authorize('delete', $result);

        $result->delete();

        ActivityHelper::log(
            'Result',
            'Deleted',
            'Result has been deleted.'
        );

        NotificationHelper::create(
            'Result Deleted',
            'Student result has been deleted successfully.',
            'info',
            'fa-trash',
            'danger',
            route('results.index')
        );
        return redirect()
            ->route('results.index')
            ->with('success', 'Result deleted successfully.');
    }
}

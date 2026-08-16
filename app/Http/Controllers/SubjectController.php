<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\NotificationHelper;
use App\Models\Course;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Subject::class);

        $subjects = Subject::with(['teachers', 'department', 'course'])
            ->forStudent()
            ->ForTeacher()
            ->search($request->search)
            ->paginate(10)
            ->withQueryString();

        return view('subjects.allSubject', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Subject::class);

        $departments = Department::all();
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('subjects.show', compact(
            'departments',
            'courses',
            'teachers'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Subject::class);

        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:50',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'exists:teachers,id',
            'status' => 'required'
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'code' => $request->code,
            'department_id' => $request->department_id,
            'course_id' => $request->course_id,
            'status' => $request->status,
        ]);

        // Insert teachers into pivot table
        $subject->teachers()->attach($request->teacher_id);

        ActivityHelper::log(
            'Subject',
            'Created',
            'Subject "' . $subject->name . '" has been created.'
        );

        NotificationHelper::create(
            'Subject Added',
            'Subject "' . $subject->name . '" has been added successfully.',
            'info',
            'fa-book-open',
            'success',
            route('subjects.index')
        );

        return redirect()->route('subjects.index')
            ->with('success', 'Subject Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::with(['teachers', 'department', 'course'])
            ->findOrFail($id);

        $this->authorize('view', $subject);

        return view('subjects.viewSubject', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::with('teachers')->findOrFail($id);

        $this->authorize('update', $subject);

        $departments = Department::all();
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('subjects.editSubject', compact(
            'subject',
            'departments',
            'courses',
            'teachers'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $this->authorize('update', $subject);

        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:50',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'exists:teachers,id',
            'status' => 'required'
        ]);

        $subject->update([
            'name' => $request->name,
            'code' => $request->code,
            'department_id' => $request->department_id,
            'course_id' => $request->course_id,
            'status' => $request->status,
        ]);

        $subject->teachers()->sync($request->teacher_id);

        ActivityHelper::log(
            'Subject',
            'Updated',
            'Subject "' . $subject->name . '" has been updated.'
        );

        NotificationHelper::create(
            'Subject Updated',
            'Subject "' . $subject->name . '" has been updated successfully.',
            'info',
            'fa-edit',
            'warning',
            route('subjects.index')
        );

        return redirect()->route('subjects.index')
            ->with('success', 'Subject Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);

        $this->authorize('delete', $subject);

        // Store name before deleting
        $subjectName = $subject->name;

        // Delete all related teachers from pivot table
        $subject->teachers()->detach();

        // Delete subject
        $subject->delete();

        ActivityHelper::log(
            'Subject',
            'Deleted',
            'Subject "' . $subject->name . '" has been deleted.'
        );

        NotificationHelper::create(
            'Subject Deleted',
            'Subject "' . $subject->name . '" has been deleted successfully.',
            'info',
            'fa-trash',
            'danger',
            route('subjects.index')
        );

        return redirect()->route('subjects.index')
            ->with('success', 'Subject Deleted Successfully');
    }
}

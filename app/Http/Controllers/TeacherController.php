<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\NotificationHelper;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $this->authorize('viewAny', Teacher::class);
    //     $teachers = Teacher::with('department')->paginate(10);
    //     // return ($teacher);

    //     return view('teachers.allTeachers', compact('teachers'));
    // }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Teacher::class);

        $teachers = Teacher::with('department')
            ->search($request->search)
            ->paginate(10)
            ->withQueryString();

        return view('teachers.allTeachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Teacher::class);
        $departments = Department::all();

        return view('teachers.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Teacher::class);
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email',
            'number'        => 'required|digits_between:10,15',
            'gender'        => 'required',
            'department' => 'required|exists:departments,id',
            'address'       => 'required|string|max:255',
            'qualification'      => 'required',
            'status'        => 'required|boolean',
        ]);

        $teacher =  Teacher::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'        => $request->number,
            'gender'        => $request->gender,
            'qualification'      => $request->qualification,
            'department_id' => $request->department,
            'address'       => $request->address,
            'status'        => $request->status,
        ]);

        ActivityHelper::log(
            'Teacher',
            'Created',
            'Teacher "' . $teacher->name . '" has been created.'
        );

        NotificationHelper::create(
            'Teacher Added',
            'Teacher "' . $teacher->name . '" has been added successfully.',
            'info',
            'fa-chalkboard-teacher',
            'success',
            route('teachers.index')
        );

        return redirect()->route('teachers.index')
            ->with('status', 'Teacher Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findorfail($id);
        $this->authorize('view', $teacher);

        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findorfail($id);
        $this->authorize('update', $teacher);

        $departments = Department::all();

        return view('teachers.updateTeacher', compact('teacher', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $this->authorize('update', $teacher);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->number;
        $teacher->gender = $request->gender;
        $teacher->qualification = $request->qualification;
        $teacher->department_id = $request->department_id;
        $teacher->address = $request->address;
        $teacher->status = $request->status;
        $teacher->save();

        ActivityHelper::log(
            'Teacher',
            'Updated',
            'Teacher "' . $teacher->name . '" has been updated.'
        );

        NotificationHelper::create(
            'Teacher Updated',
            'Teacher "' . $teacher->name . '" has been updated successfully.',
            'info',
            'fa-edit',
            'warning',
            route('teachers.index')
        );


        return redirect()->route('teachers.index')
            ->with('status', 'Teacher Updated Successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $this->authorize('delete', $teacher);

        $teacher->delete();

        ActivityHelper::log(
            'Teacher',
            'Deleted',
            'Teacher "' . $teacher->name . '" has been deleted.'
        );

        NotificationHelper::create(
            'Teacher Deleted',
            'Teacher "' . $teacher->name . '" has been deleted successfully.',
            'info',
            'fa-trash',
            'danger',
            route('teachers.index')
        );

        return redirect()->route('teachers.index')
            ->with('status', 'Teacher Deleted Successfully');
    }
}

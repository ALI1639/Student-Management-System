<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\NotificationHelper;
use App\Models\Course;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny', Student::class);

        $students = Student::with(['department', 'course'])
            ->search($request->search)
            ->paginate(10)
            ->withQueryString();

        return view('students.allStudents', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Student::class);
        $departments = Department::all();

        $courses = Course::all();

        return view('students.create', compact('departments', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Student::class);

        $request->validate([
            'roll_number'   => 'required|unique:students,roll_number',
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email',
            'number'        => 'required|unique:students,phone|digits_between:10,15',
            'gender'        => 'required',
            'department'    => 'required|exists:departments,id',
            'course'        => 'required|exists:courses,id',
            'dob'           => 'required|date',
            'address'       => 'required|string|max:255',
            'semester'      => 'required|integer|min:1|max:8',
            'status'        => 'required|boolean',
        ]);

        $student = Student::create([

            'roll_number'   => $request->roll_number,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->number,
            'gender'        => $request->gender,
            'department_id' => $request->department,
            'course_id'     => $request->course,
            'date_of_birth' => $request->dob,
            'address'       => $request->address,
            'semester'      => $request->semester,
            'status'        => $request->status,

        ]);

        // Recent Activity
        ActivityHelper::log(
            'Student',
            'Created',
            'Student "' . $student->name . '" has been created.'
        );

        NotificationHelper::create(
            'Student Added',
            'New student "' . $student->name . '" has been added successfully.',
            'info',
            'fa-user-plus',
            'success',
            route('students.index')
        );

        return redirect()->route('students.index')
            ->with('status', 'Student Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with(['department', 'course'])->findOrFail($id);
        $this->authorize('view', $student);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $this->authorize('update', $student);

        $departments = Department::all();

        $courses = Course::all();

        return view('students.updateStudent', compact('student', 'departments', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $this->authorize('update', $student);

        $student->roll_number = $request->roll_number;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->number;
        $student->gender = $request->gender;
        $student->date_of_birth = $request->dob;
        $student->address = $request->address;
        $student->semester = $request->semester;
        $student->department_id = $request->department_id;
        $student->course_id = $request->course_id;
        $student->status = $request->status;

        $student->save();

        ActivityHelper::log(
            'Student',
            'Updated',
            'Student "' . $student->name . '" has been updated.'
        );

        // Notification Create
        NotificationHelper::create(
            'Student Updated',
            'Student "' . $student->name . '" has been updated successfully.',
            'info',
            'fa-user-edit',
            'warning',
            route('students.index')
        );


        return redirect()->route('students.index')
            ->with('status', 'Student Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        $this->authorize('delete', $student);

        $name = $student->name;

        $student->delete();

        ActivityHelper::log(
            'Student',
            'Deleted',
            'Student "' . $name . '" has been deleted.'
        );

        // Notification Create
        NotificationHelper::create(
            'Student Deleted',
            'Student "' . $name . '" has been deleted successfully.',
            'info',
            'fa-user-times',
            'danger',
            route('students.index')
        );

        return redirect()->route('students.index')
            ->with('status', 'Student Deleted Successfully');
    }
}

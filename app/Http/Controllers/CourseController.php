<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\NotificationHelper;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $this->authorize('viewAny', Course::class);
    //     $course = Course::with('department')->paginate(10);

    //     return view('courses.allCourses', compact('course'));
    // }

    public function index(Request $request)
    {
        $this->authorize('viewAny', Course::class);

        $course = Course::with('department');

        if ($request->filled('search')) {

            $search = $request->search;

            $course->where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('semester', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($q) use ($search) {

                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $course = $course->paginate(10)->withQueryString();

        return view('courses.allCourses', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Course::class);
        $departments = Department::all();

        return view('courses.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $this->authorize('create', Course::class);
        $req->validate([
            'department' => 'required|exists:departments,id',
            'name' => 'required',
            'code' => 'required|unique:courses,code',
            'hours' => 'required',
            'semester' => 'required',
            'status' => 'required|boolean',
        ]);

        $course = new Course();

        $course->department_id = $req->department;
        $course->name = $req->name;
        $course->code = $req->code;
        $course->credit_hours = $req->hours;
        $course->semester = $req->semester;
        $course->status = $req->status;
        $course->save();

        ActivityHelper::log(
            'Course',
            'Created',
            'Course "' . $course->name . '" has been created.'
        );

        NotificationHelper::create(
            'Course Added',
            'Course "' . $course->name . '" has been added successfully.',
            'info',
            'fa-book',
            'success',
            route('courses.index')
        );

        return redirect()->route('courses.index')
            ->with('status', 'New Course Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with('department')->findOrFail($id);
        $this->authorize('view', $course);

        return view('courses.viewCourse', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findorfail($id);
        $this->authorize('update', $course);

        $departments = Department::all();

        return view('courses.updateCourse', compact('course', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
        $this->authorize('update', $course);
        $course->update([
            'department_id' => $request->department_id,
            'name'          => $request->name,
            'code'          => $request->code,
            'credit_hours'         => $request->hours,
            'semester'      => $request->semester,
            'status'        => $request->status,
        ]);

        ActivityHelper::log(
            'Course',
            'Updated',
            'Course "' . $course->name . '" has been updated.'
        );

        NotificationHelper::create(
            'Course Updated',
            'Course "' . $course->name . '" has been updated successfully.',
            'info',
            'fa-edit',
            'warning',
            route('courses.index')
        );


        return redirect()->route('courses.index')
            ->with('status', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        $this->authorize('delete', $course);

        $course->delete();

        ActivityHelper::log(
            'Course',
            'Deleted',
            'Course "' . $course->name . '" has been deleted.'
        );

        NotificationHelper::create(
            'Course Deleted',
            'Course "' . $course->name . '" has been deleted successfully.',
            'info',
            'fa-trash',
            'danger',
            route('courses.index')
        );

        return redirect()->route('courses.index')
            ->with('status', 'Course Deleted Successfully.');
    }
}

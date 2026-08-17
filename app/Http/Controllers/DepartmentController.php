<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityHelper;
use App\Helpers\NotificationHelper;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Department::class);

        $depart = Department::search($request->search)
            ->paginate(10)
            ->withQueryString();

        return view('departments.alldeparts', compact('depart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Department::class);

        return view('departments.adddepart');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $this->authorize('create', Department::class);

        $req->validate([
            'name'   => 'required',
            'code'   => 'required|unique:departments,code',
            'status' => 'required',
        ]);

        $department = Department::create([
            'name'   => $req->name,
            'code'   => $req->code,
            'status' => $req->status,
        ]);

        ActivityHelper::log(
            'Department',
            'Created',
            'Department "' . $department->name . '" has been created.'
        );

        NotificationHelper::create(
            'Department Added',
            'Department "' . $department->name . '" has been added successfully.',
            'info',
            'fa-building',
            'success',
            route('departments.index')
        );

        return redirect()->route('departments.index')
            ->with('status', 'New Department Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $depart = Department::findOrFail($id);

        $this->authorize('view', $depart);

        return view('departments.viewdepart', compact('depart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $depart = Department::findOrFail($id);

        $this->authorize('update', $depart);

        return view('departments.updatedepart', compact('depart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $depart = Department::findOrFail($id);

        $this->authorize('update', $depart);

        $req->validate([
            'name'   => 'required',
            'code'   => 'required',
            'status' => 'required',
        ]);

        $depart->update([
            'name'   => $req->name,
            'code'   => $req->code,
            'status' => $req->status,
        ]);

        ActivityHelper::log(
            'Department',
            'Updated',
            'Department "' . $depart->name . '" has been updated.'
        );

        NotificationHelper::create(
            'Department Updated',
            'Department "' . $depart->name . '" has been updated successfully.',
            'info',
            'fa-edit',
            'warning',
            route('departments.index')
        );

        return redirect()->route('departments.index')
            ->with('status', 'Department Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $depart = Department::findOrFail($id);

        $this->authorize('delete', $depart);

        $depart->delete();

        ActivityHelper::log(
            'Department',
            'Deleted',
            'Department "' . $depart->name . '" has been deleted.'
        );

        NotificationHelper::create(
            'Department Deleted',
            'Department "' . $depart->name . '" has been deleted successfully.',
            'info',
            'fa-trash',
            'danger',
            route('departments.index')
        );

        return redirect()->route('departments.index')
            ->with('status', 'Department Deleted Successfully.');
    }

    /**
     * Delete all departments.
     */
    public function destroyAll()
    {
        $this->authorize('delete', Department::class);

        Schema::disableForeignKeyConstraints();

        Course::truncate();
        Department::truncate();

        Schema::enableForeignKeyConstraints();

        return redirect()->route('departments.index')
            ->with('status', 'Deleted All Departments Successfully.');
    }
}

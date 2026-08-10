<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display Recent Activities
     */
    public function index(Request $request)
    {
        if (auth()->user()->role != 'Admin') {
            abort(403);
        }

        $activities = Activity::with('user');

        // Filter by Module
        if ($request->filled('module')) {
            $activities->where('module', $request->module);
        }

        // Filter by Action
        if ($request->filled('action')) {
            $activities->where('action', $request->action);
        }

        $activities = $activities->latest()
            ->paginate(15)
            ->withQueryString();

        return view('activities.index', compact('activities'));
    }

    public function destroyAll()
    {
        Activity::truncate();

        return redirect()->route('activities.index')
            ->with('status', 'Deleted All Activity Successfully.');
    }
}

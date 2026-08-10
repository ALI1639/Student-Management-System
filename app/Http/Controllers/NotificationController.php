<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Gate;

class NotificationController extends Controller
{

    /**
     * Display All Notifications
     */
    public function index()
    {
        Gate::authorize('manage-notifications');

        $notifications = Notification::latest()->paginate(15);

        return view('notifications.index', compact('notifications'));
    }



    /**
     * Mark Single Notification as Read
     */
    public function read(string $id)
    {
        Gate::authorize('manage-notifications');

        $notification = Notification::findOrFail($id);

        $notification->update([

            'is_read' => true,

        ]);


        if ($notification->url) {

            return redirect($notification->url);
        }

        return back();
    }



    /**
     * Mark All Notifications as Read
     */
    public function readAll()
    {
        Gate::authorize('manage-notifications');

        Notification::where('is_read', false)->update([

            'is_read' => true,

        ]);

        return back()->with(
            'success',
            'All notifications marked as read.'
        );
    }



    /**
     * Delete Notification
     */
    public function destroy(string $id)
    {
        Gate::authorize('manage-notifications');
        $notification = Notification::findOrFail($id);

        $notification->delete();

        return back()->with(
            'success',
            'Notification deleted successfully.'
        );
    }

    public function destroyAll()
    {
        Notification::truncate();

        return redirect()->route('notifications.index')
            ->with('status', 'Deleted All Notification Successfully.');
    }
}

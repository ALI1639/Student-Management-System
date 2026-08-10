<?php

namespace App\Helpers;

use App\Models\Notification;

class NotificationHelper
{

    /**
     * Create New Notification
     */
    public static function create(
        $title,
        $message,
        $type = 'info',
        $icon = 'fa-bell',
        $color = 'primary',
        $url = null
    ) {

        Notification::create([

            'title' => $title,

            'message' => $message,

            'type' => $type,

            'icon' => $icon,

            'color' => $color,

            'url' => $url,

            'is_read' => false,

        ]);
    }
}

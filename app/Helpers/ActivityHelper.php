<?php

namespace App\Helpers;

use App\Models\Activity;

class ActivityHelper
{
    /**
     * Save Activity
     */
    public static function log($module, $action, $description)
    {
        Activity::create([

            'user_id'     => auth()->id(),

            'module'      => $module,

            'action'      => $action,

            'description' => $description,

            'ip_address'  => request()->ip(),

            'browser'     => request()->userAgent(),

        ]);
    }
}

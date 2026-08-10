<?php

namespace App\Policies;

use App\Models\User;

class ReportPolicy
{
    public function viewReport(User $user): bool
    {
        return $user->role === 'Admin';
    }
}

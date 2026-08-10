<?php

namespace App\Policies;

use App\Models\Attendance;
use App\Models\User;

class AttendancePolicy
{
    // Admin & Teacher
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Teacher']);
    }

    // Admin & Teacher
    public function view(User $user, Attendance $attendance): bool
    {
        return in_array($user->role, ['Admin', 'Teacher']);
    }

    // Admin & Teacher
    public function create(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Teacher']);
    }

    // Admin & Teacher
    public function update(User $user, Attendance $attendance): bool
    {
        return in_array($user->role, ['Admin', 'Teacher']);
    }

    // Only Admin
    public function delete(User $user, Attendance $attendance): bool
    {
        return $user->role === 'Admin';
    }
}

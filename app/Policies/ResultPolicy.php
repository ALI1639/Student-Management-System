<?php

namespace App\Policies;

use App\Models\Result;
use App\Models\User;

class ResultPolicy
{
    // Admin & Teacher
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Teacher', 'Student']);
    }

    // Admin, Teacher (Student ka own result baad mein)
    public function view(User $user, Result $result): bool
    {
        return in_array($user->role, ['Admin', 'Teacher', 'Student']);
    }

    // Admin & Teacher
    public function create(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Teacher']);
    }

    // Admin & Teacher
    public function update(User $user, Result $result): bool
    {
        return in_array($user->role, ['Admin', 'Teacher']);
    }

    // Only Admin
    public function delete(User $user, Result $result): bool
    {
        return $user->role === 'Admin';
    }
}

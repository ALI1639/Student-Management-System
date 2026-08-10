<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;

class SubjectPolicy
{
    // Admin & Teacher
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Teacher', 'Student']);
    }

    // Admin & Teacher
    public function view(User $user, Subject $subject): bool
    {
        return in_array($user->role, ['Admin', 'Teacher', 'Student']);
    }

    // Only Admin
    public function create(User $user): bool
    {
        return $user->role === 'Admin';
    }

    // Only Admin
    public function update(User $user, Subject $subject): bool
    {
        return $user->role === 'Admin';
    }

    // Only Admin
    public function delete(User $user, Subject $subject): bool
    {
        return $user->role === 'Admin';
    }
}

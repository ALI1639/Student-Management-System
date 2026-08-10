<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

class StudentPolicy
{
    // Admin & Teacher can see student list
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Teacher']);
    }

    // Admin & Teacher can view single student
    public function view(User $user, Student $student): bool
    {
        return in_array($user->role, ['Admin', 'Teacher']);
    }

    // Only Admin can create
    public function create(User $user): bool
    {
        return $user->role === 'Admin';
    }

    // Only Admin can update
    public function update(User $user, Student $student): bool
    {
        return $user->role === 'Admin';
    }

    // Only Admin can delete
    public function delete(User $user, Student $student): bool
    {
        return $user->role === 'Admin';
    }
}

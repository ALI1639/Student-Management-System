<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;

class TeacherPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'Admin';
    }

    public function view(User $user, Teacher $teacher): bool
    {
        return $user->role === 'Admin';
    }

    public function create(User $user): bool
    {
        return $user->role === 'Admin';
    }

    public function update(User $user, Teacher $teacher): bool
    {
        return $user->role === 'Admin';
    }

    public function delete(User $user, Teacher $teacher): bool
    {
        return $user->role === 'Admin';
    }
}

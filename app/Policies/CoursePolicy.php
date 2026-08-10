<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'Admin';
    }

    public function view(User $user, Course $course): bool
    {
        return $user->role === 'Admin';
    }

    public function create(User $user): bool
    {
        return $user->role === 'Admin';
    }

    public function update(User $user, Course $course): bool
    {
        return $user->role === 'Admin';
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->role === 'Admin';
    }
}

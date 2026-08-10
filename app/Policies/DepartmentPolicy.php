<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;

class DepartmentPolicy
{
    /**
     * Display all departments
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'Admin';
    }

    /**
     * Display single department
     */
    public function view(User $user, Department $department): bool
    {
        return $user->role === 'Admin';
    }

    /**
     * Create department
     */
    public function create(User $user): bool
    {
        return $user->role === 'Admin';
    }

    /**
     * Edit department
     */
    public function update(User $user, Department $department): bool
    {
        return $user->role === 'Admin';
    }

    /**
     * Delete department
     */
    public function delete(User $user, Department $department): bool
    {
        return $user->role === 'Admin';
    }
}

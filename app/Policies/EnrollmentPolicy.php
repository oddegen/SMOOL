<?php

namespace App\Policies;

use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EnrollmentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Enrollment $enrollment): bool
    {
        return $user->id === $enrollment->student_id || $user->role->name === 'Teacher';
    }

    public function create(User $user): bool
    {
        return $user->role->name === 'Teacher';
    }

    public function update(User $user, Enrollment $enrollment): bool
    {
        return $user->role->name === 'Teacher';
    }

    public function delete(User $user, Enrollment $enrollment): bool
    {
        return $user->role->name === 'Teacher';
    }
}

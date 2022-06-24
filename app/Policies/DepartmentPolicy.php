<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->key === 'ceo') {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Department $department)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user)
    {
        return $user->key === 'ceo';
    }

    public function delete(User $user)
    {
        return $user->key === 'ceo';
    }

    public function restore(User $user, Department $department)
    {
        //
    }

    public function forceDelete(User $user, Department $department)
    {
        //
    }
}

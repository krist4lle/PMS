<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function update(User $user)
    {
        return $user->key === 'ceo';
    }

    public function delete(User $user)
    {
        return $user->key === 'ceo';
    }

}

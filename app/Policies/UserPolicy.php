<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
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
        return $user->position->permission->title !== 'worker';
    }

    public function view(User $user, User $model)
    {
        //
    }

    public function create(User $user)
    {
        return $user->position->permission->title !== 'worker';
    }

    public function update(User $user, User $model)
    {
        $departmentRule = $user->department->name === $model->department->name;
        $userRule = $user->key !== null;

        return $departmentRule && $userRule;
    }

    public function delete(User $user, User $model)
    {
        $departmentRule = $user->department->name === $model->department->name;
        $userRule = $user->key !== null;

        return $departmentRule && $userRule;
    }

    public function restore(User $user, User $model)
    {
        //
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }
}

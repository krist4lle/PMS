<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->key === 'ceo') {

            return true;
        }

        return null;
    }

    public function create(User $user)
    {
        return $user->key !== 'worker';
    }

    public function update(User $user, User $model)
    {
        $model->load('parent');
        if ($model->key === 'ceo') {

            return false;
        }

        return $model->parent->key === $user->key;
    }

    public function delete(User $user, User $model)
    {
        $model->load('parent');
        if ($model->key === 'ceo') {

            return false;
        }

        return $model->parent->key === $user->key;
    }
}

<?php

namespace App\Policies;

use App\Models\Position;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->key === 'ceo';
    }

    public function update(User $user)
    {
        return $user->key === 'ceo';
    }

    public function delete(User $user)
    {
        return $user->key === 'ceo';
    }
}

<?php

namespace App\Policies;

use App\Models\Position;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Position $position)
    {
        //
    }

    public function create(User $user)
    {
        return $user->id > 0;
    }

    public function update(User $user, Position $position)
    {
        return $user->key == 'ceo';
    }

    public function delete(User $user, Position $position)
    {
        return $user->key == 'ceo';
    }

    public function restore(User $user, Position $position)
    {
        //
    }

    public function forceDelete(User $user, Position $position)
    {
        //
    }
}

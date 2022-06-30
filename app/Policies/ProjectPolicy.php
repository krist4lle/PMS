<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
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
        return $user->key === 'headManagement';
    }

    public function edit(User $user)
    {
        return $user->key !== 'worker';
    }

    public function update(User $user, Project $project)
    {
        if ($user->key === 'headManagement' || $project->manager->id === $user->id) {

            return true;
        }

        return false;
    }

    public function delete(User $user)
    {
        return $user->key === 'headManagement';
    }
}

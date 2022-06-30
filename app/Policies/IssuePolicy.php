<?php

namespace App\Policies;

use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IssuePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->key === 'ceo') {

            return true;
        }

        return null;
    }

    public function create(User $user, Project $project)
    {
        if ($project->manager->id === $user->id) {

            return true;
        }

        return $user->key === 'headManagement';
    }

    public function update(User $user, Issue $issue, Project $project)
    {
        if ($project->manager->id === $user->id) {

            return true;
        }

        return $user->key === 'headManagement';
    }

    public function delete(User $user, Issue $issue, Project $project)
    {
        if ($project->manager->id === $user->id) {

            return true;
        }

        return $user->key === 'headManagement';
    }
}

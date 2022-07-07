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
        if ($project->manager->id === $user->id
            || $user->key === 'headManagement') {

            return true;
        }

        return false;
    }

    public function status(User $user, Issue $issue, Project $project)
    {
        $project->load('manager');
        if ($project->manager->id === $user->id
            || $user->key === 'headManagement'
            || !empty($user->projects()->find($project))) {

            return true;
        }

        return false;
    }

    public function update(User $user, Issue $issue, Project $project)
    {
        if ($project->manager->id === $user->id
            || $user->key === 'headManagement') {

            return true;
        }

        return false;
    }

    public function delete(User $user, Issue $issue, Project $project)
    {
        if ($project->manager->id === $user->id
            || $user->key === 'headManagement') {

            return true;
        }

        return false;
    }
}

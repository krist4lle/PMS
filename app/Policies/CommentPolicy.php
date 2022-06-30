<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->key === 'ceo') {

            return true;
        }

        return null;
    }

    public function update(User $user, Comment $comment, Project $project)
    {
        $comment->load('user');
        $project->load('manager');
        if ($project->manager->id === $user->id
            || $user->key === 'headManagement'
            || $comment->user->id === $user->id) {

            return true;
        }

        return false;
    }

    public function delete(User $user, Comment $comment, Project $project)
    {
        $comment->load('user');
        $project->load('manager');
        if ($project->manager->id === $user->id
            || $user->key === 'headManagement'
            || $comment->user->id === $user->id) {

            return true;
        }

        return false;
    }
}

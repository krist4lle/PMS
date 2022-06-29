<?php

namespace App\Service;

use App\Models\Comment;
use App\Models\Issue;
use App\Models\User;

class CommentService
{
    public function commentSave(Comment $comment, array $data): void
    {
        $comment->content = $data['content'];
        $user = User::find($data['user']);
        $comment->user()->associate($user);
        $issue = Issue::find($data['issue']);
        $comment->issue()->associate($issue);
        $comment->save();
    }
}

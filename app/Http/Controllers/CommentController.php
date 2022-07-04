<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;
use App\Models\Project;
use App\Service\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreRequest $request, CommentService $service)
    {
        $data = $request->validated();
        $service->commentSave(new Comment(), $data);

        return redirect()->back()->with('success', 'Comment added');
    }

    public function updateComment(UpdateRequest $request, CommentService $service)
    {
        $data = $request->validated();

        $project = Project::find($data['project_id']);
        $comment = Comment::find($data['comment_id']);
        $this->authorize('update', [$comment, $project]);
        $service->commentUpdate($comment, $data['content']);

        return response()->json([
            'comment' => $comment->content,
        ]);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('update', [$comment, $comment->issue->project]);
        $comment->delete();

        return redirect()->back();
    }
}

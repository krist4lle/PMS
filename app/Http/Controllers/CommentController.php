<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;
use App\Models\Project;
use App\Service\CommentService;

class CommentController extends Controller
{
    public function store(StoreRequest $request, CommentService $service)
    {
        $data = $request->validated();
        $service->commentSave(new Comment(), $data);

        return redirect()->back()->with('success', 'Comment added');
    }

    public function update(UpdateRequest $request, Comment $comment, CommentService $service)
    {
        $content = $request->validated('content');
        $project = Project::find($request->validated('project'));
        $this->authorize('update', [$comment, $project]);
        $service->commentUpdate($comment, $content);

        return redirect()->back()->with('success', 'Comment successfully edited');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('update', [$comment, $comment->issue->project]);
        $comment->delete();

        return redirect()->back();
    }
}

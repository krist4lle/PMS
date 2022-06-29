<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;
use App\Models\Issue;
use App\Models\User;
use App\Service\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request, CommentService $service)
    {
        $data = $request->validated();
        $service->commentSave(new Comment(), $data);

        return redirect()->back()->with('success', 'Comment added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(UpdateRequest $request, Comment $comment, CommentService $service)
    {
        $content = $request->validated('content');
        $service->commentUpdate($comment, $content);

        return redirect()->back()->with('success', 'Comment successfully edited');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}

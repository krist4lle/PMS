@extends('layouts.app')
@section('content')
    <new-component></new-component>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col justify-content-between">
                    <h1>
                        Issue: {{ $issue->title }}
                        @if($issue->status->slug === 'new')
                            <span class="badge badge-danger">{{ $issue->status->name }}</span>
                        @elseif($issue->status->slug === 'done')
                            <span class="badge badge-success">{{ $issue->status->name }}</span>
                        @else
                            <span class="badge badge-warning">{{ $issue->status->name }}</span>
                        @endif
                    </h1>
                </div>
                <div>
                    <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-secondary">To Project</a>
                </div>
            </div>
        </div>
    </section>
    @if(session()->has('success'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <section>
        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <h4>Description</h4>
                </div>
                <div class="col-6">
                    <p>{{ $issue->description }}</p>
                </div>
                <div class="col-6 row justify-content-end">
                    @if($issue->status->slug !== 'done')
                        <form action="{{ route('issues.status', $issue) }}" method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-outline-info">
                                @if($issue->status->slug === 'new')
                                    Accept Issue
                                @elseif($issue->status->slug === 'in_progress')
                                    Send to review
                                @else
                                    Close Issue
                                @endif
                            </button>
                        </form>
                    @endif
                    <div class="pl-2">
                        <button class="btn btn-outline-secondary" data-toggle="modal"
                                data-target="#Modal">
                            Edit Issue
                        </button>
                    </div>
                    <form class="pl-2" action="{{ route('issues.destroy', $issue) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger">
                            Delete Issue
                        </button>
                    </form>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-4 invoice-col">
                    <address>
                        <b>Created</b><br>
                        <em>{{ $issue->created_at }}</em><br>
                        <b>Updated</b><br>
                        <em>{{ $issue->updated_at }}</em><br>
                        <b>Closed</b><br>
                        @if(empty($issue->finished_at))
                            <em>N/A</em>
                        @else
                            <em>{{ $issue->finished_at }}</em>
                        @endif
                    </address>
                </div>
                <div class="col-4 invoice-col">
                    <address>
                        <b>Project</b>
                        <br>
                        <em>
                            {{ $project->title }}
                            <a href="{{ route('projects.show', $project) }}">
                                <i class="nav-icon fas fa-arrow-circle-right"></i>
                            </a>
                        </em>
                        <br>
                        <b>Assignee</b>
                        <br>
                        <em>
                            {{ $assignee->first_name }} {{ $assignee->last_name }}:
                            "{{ $assignee->position->title }}"
                        </em>
                        <a href="{{ route('users.show', $assignee) }}">
                            <i class="nav-icon fas fa-arrow-circle-right"></i>
                        </a>
                        <br>
                        <b>Time spent</b>
                        <br>
                        @if(empty($issue->finished_at))
                            <em>N/A</em>
                        @else
                            <em>{{ $timeSpent }} - hours</em>
                        @endif
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive pt-3">
                    <h5>
                        <i class="far fa-comments mr-1"></i> Comments ({{ $issue->comments_count }})
                    </h5>
                    <form action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="issue" value="{{ $issue->id }}">
                        <textarea class="form-control form-control-sm" placeholder="Type a comment"
                                  name="content"></textarea>
                        <button type="submit" class="btn btn-sm btn-outline-secondary mt-2">Add Comment</button>
                    </form>
                    <br>
                    @foreach($comments as $comment)
                        <div class="post row" id="sid{{ $comment->id }}">
                            <div class="user-block col-9">
                                <img class="img-circle img-bordered-sm"
                                     src="{{ asset($comment->user->avatar) }}" alt="user_image">
                                <span class="username">
                                <a href="#">
                                    {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                </a>
                            </span>
                                <span class="description">Shared -
                                    {{ \Carbon\Carbon::make($comment->updated_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-3 justify-content-end row">
                                <div class="mx-2">
                                    <button onclick="formShow(this)" class="btn btn-sm btn-outline-info">
                                        <i class="nav-icon fas fa-pen"></i>
                                        Edit
                                    </button>
                                </div>
                                <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="nav-icon fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                            <p class="px-2">{{ $comment->content }}</p>
                            <form class="col-12" method="post" action="{{ route('comments.update', $comment) }}">
                                @csrf
                                @method('put')
                                <textarea class="form-control form-control-sm" placeholder="Type a comment"
                                          name="content">{{ $comment->content }}</textarea>
                                <button type="submit" class="btn btn-sm btn-outline-secondary mt-2">
                                    Edit Comment
                                </button>
                                <a onclick="formHide(this)" class="btn btn-sm btn-outline-danger mt-2">Cancel</a>
                            </form>
                        </div>
                    @endforeach
                    <script>
                        function formShow(button) {
                            let form = button.parentElement;
                            if (form.style.display === 'none') {
                                form.style.display = 'block';
                            } else {
                                form.style.display = 'none';
                            }
                        }

                        function formHide(button) {
                            button.parentElement.form.style.display = 'none';
                        }
                    </script>
                </div>
            </div>
        </div>
    </section>
    @include('issues.modal.edit')
@endsection

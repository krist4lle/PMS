@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col row justify-content-between">
                    <div>
                        <h1>
                            Project: <em>{{ $project->title }}</em>
                            @if($project->finished_at !== null)
                                <span class="badge badge-success">Success</span>
                            @else
                                <span class="badge badge-warning">In progress</span>
                            @endif
                        </h1>
                    </div>
                    <div>
                        <a href="{{ route('projects.index') }}" type="button" class="btn btn-outline-secondary">
                            To Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(session()->has('error'))
        <div class="alert alert-danger mt-2" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
    <section class="content">
        <div class="card">
            <div class="card-body" style="display: block;">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    Issues
                                    <a href="{{ route('issues.create') }}" class="float-right btn btn-outline-info">
                                        Create Issue
                                    </a>
                                </h4>
                                @foreach($issues as $issue)
                                    <div class="post">
                                        <div class="row justify-content-between">
                                            <div>
                                                <label>
                                                    {{ $issue->title }}
                                                    <a href="{{ route('issues.show', $issue) }}">
                                                        <i class="nav-icon fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </label>
                                            </div>
                                            <div>
                                                Status:
                                                <span class="badge badge-info">{{ $issue->status->status }}</span>
                                            </div>
                                        </div>
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                 src="{{ asset($issue->assignee->avatar) }}" alt="user_image">
                                            <span class="username">
                                                <a href="#">
                                                    {{ $issue->assignee->first_name }} {{ $issue->assignee->last_name }}
                                                </a>
                                            </span>
                                            <span class="description">
                                                Created:
                                                {{ $issue->created_at }}
                                            </span>
                                        </div>
                                        <p>{{ $issue->description }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3>Description</h3>
                        <p class="text-muted">
                            {{ $project->description }}
                        </p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Client Company
                                <b class="d-block">
                                    {{ $client->title }}
                                    <a href="{{ route('clients.show', $client) }}"><i class="nav-icon fas fa-link"></i></a>
                                </b>
                            </p>
                            <p class="text-sm">Project Leader
                                <b class="d-block">
                                    {{ $manager->first_name }} {{ $manager->last_name }}
                                    <a href=""><i class="nav-icon fas fa-link"></i></a>
                                </b>
                            </p>
                            <p>Team</p>
                            @foreach($users as $user)
                                <div>
                                    <b>{{ $user->first_name }} {{ $user->last_name }}</b> -
                                    "{{ $user->position->title }}"
                                    <a href=""><i class="nav-icon fas fa-link"></i></a>
                                </div>
                            @endforeach
                            <div class="pt-3 pl-2 row">
                                <div>
                                    <form action="{{ route('projects.finished', $project) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" value="{{ date('Y-m-d H:i:s') }}" name="finished_at">
                                        @if($project->finished_at !== null)
                                            <button class="btn btn-outline-info" type="submit">
                                                Start Project
                                            </button>
                                        @else
                                            <button class="btn btn-outline-info" type="submit">
                                                Close Project
                                            </button>
                                        @endif
                                    </form>
                                </div>
                                <div class="pl-3">
                                    <a class="btn btn-outline-secondary" href="{{ route('projects.edit', $project) }}">
                                        Edit Project
                                    </a>
                                </div>
                                <div class="pl-3">
                                    <form action="{{ route('projects.destroy', $project) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger" type="submit">
                                            Delete Project
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

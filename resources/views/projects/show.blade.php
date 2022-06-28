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
                                <span class="badge badge-success">Closed</span>
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
    @if($errors->has('error'))
        <div class="alert alert-danger mt-2" role="alert">
            {{ $errors->first('error') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger mt-2" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session()->get('success') }}
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
                                    <button class="float-right btn btn-outline-info" data-toggle="modal"
                                            data-target="#Modal">
                                        Create Issue
                                    </button>
                                </h4>
                                <div class="card-body p-0">
                                    <table class="table table-striped projects">
                                        <thead>
                                        <tr>
                                            <th style="width: 10%">#</th>
                                            <th style="width: 20%">Title</th>
                                            <th style="width: 20%">Assignee</th>
                                            <th style="width: 5%">Status</th>
                                            <th style="width: 5%">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($issues as $issue)
                                            <tr>
                                                <td>{{ $issue->id }}</td>
                                                <td>{{ $issue->title }}</td>
                                                <td>
                                                    {{ $issue->assignee->first_name }} {{ $issue->assignee->last_name }}
                                                </td>
                                                <td>
                                                    @if($issue->status->slug === 'new')
                                                        <span class="badge badge-danger">
                                                            {{ $issue->status->name }}
                                                        </span>
                                                    @elseif($issue->status->slug === 'done')
                                                        <span class="badge badge-success">
                                                            {{ $issue->status->name }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            {{ $issue->status->name }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm mx-2"
                                                       href="{{ route('issues.show', $issue) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-sm">Deadline
                                        <b class="d-block">
                                            {{ \Carbon\Carbon::create($project->deadline)->toDateString() }}
                                        </b>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="text-sm">Closed
                                        @if($project->finished_at !== null)
                                        <b class="d-block">
                                            {{ \Carbon\Carbon::create($project->finished_at)->toDateString() }}
                                        </b>
                                        @else
                                            <b class="d-block">N/A</b>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="pt-3 pl-2 row">
                                <div>
                                    <form action="{{ route('projects.status', $project) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" value="{{ date('Y-m-d H:i:s') }}" name="finished_at">
                                        <button class="btn btn-outline-info" type="submit">
                                            @if($project->finished_at !== null)
                                                Launch Project
                                            @else
                                                Close Project
                                            @endif
                                        </button>
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
    @include('projects.modal.issues_create')
@endsection

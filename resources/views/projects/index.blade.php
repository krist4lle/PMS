@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Projects</h1>
                    <a href="{{ route('projects.create') }}" class="btn btn-info mt-2">Create a new Project</a>
                </div>
            </div>
        </div>
    </section>
    @if(session()->has('success'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger mt-2" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">Project Name</th>
                        <th style="width: 10%">Project Manager</th>
                        <th style="width: 30%">Team Members</th>
                        <th style="width: 8%" class="text-center">Status</th>
                        <th style="width: 20%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>
                                <a>{{ $project->title }}</a>
                                <br>
                                <small>
                                    Created:
                                    {{ \Carbon\Carbon::make($project->created_at)->format('j-F-Y') }}
                                </small>
                            </td>
                            <td>
                                <a href="{{ route('users.show', $project->manager) }}" class="col-10">
                                    <img src="{{ asset($project->manager->avatar) }}" alt="project_manager" class="col-5">
                                </a>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    @foreach($project->users as $user)
                                        <li class="list-inline-item">
                                            <a href="{{ route('users.show', $user) }}">
                                                <img alt="$users_avatar" class="table-avatar"
                                                     src="{{ asset($user->avatar) }}">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="project-state">
                                @if($project->finished_at !== null)
                                    <span class="badge badge-success">Closed</span>
                                @else
                                    <span class="badge badge-warning">In progress</span>
                                @endif
                            </td>
                            <td class="project-actions text-right row">
                                <a class="btn btn-primary btn-sm mx-2" href="{{ route('projects.show', $project) }}">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm mx-2" href="{{ route('projects.edit', $project) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form action="{{ route('projects.destroy', $project) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm mx-2" type="submit">
                                        <i class="fas fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $projects->withQueryString() }}
            </div>
        </div>
    </section>
@endsection

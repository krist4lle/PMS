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
                                <small>{{ \Carbon\Carbon::make($project->created_at)->format('j-F-Y') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('profile.index', $project->manager) }}" class="col-10">
                                    <img src="{{ $project->manager->avatar }}" alt="project_manager" class="col-9">
                                </a>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    @foreach($project->users as $user)
                                        <li class="list-inline-item">
                                            <a href="{{ route('profile.index', $user) }}">
                                                <img alt="$users_avatar" class="table-avatar" src="{{ $user->avatar }}">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="project-state">
                                @if($project->finished_at !== null)
                                    <span class="badge badge-success">Success</span>
                                @else
                                    <span class="badge badge-warning">In progress</span>
                                @endif
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('projects.show', $project) }}">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="#">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
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

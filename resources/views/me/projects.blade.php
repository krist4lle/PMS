@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="col row justify-content-between">
                <div>
                    <h1>My Projects</h1>
                </div>
                <div>
                    <a href="{{ route('me.index') }}" type="button" class="btn btn-outline-secondary">
                        My Profile
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 20%">Project</th>
                        <th style="width: 40%">Description</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 20%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->description }}</td>
                            <td>
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
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

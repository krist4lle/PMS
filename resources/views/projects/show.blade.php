@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col row justify-content-between">
                    <div>
                        <h1>Project: <em>{{ $project->title }}</em></h1>
                    </div>
                    <div>
                        <a href="{{ route('projects.index') }}" type="button" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body" style="display: block;">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12">
                                <h4>Issues</h4>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                             alt="user image">
                                        <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                                        <span class="description">Shared publicly - 7:45 PM today</span>
                                    </div>
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('content')
    <div class="float-right">
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary mt-2">To Users</a>
    </div>
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- User Card -->
                <div class="col-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset($user->avatar) }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h3>
                            <p class="text-muted text-center">{{ $user->position->title }}</p>
                        </div>
                    </div>
                    <!-- About User -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-envelope mr-1"></i>Email</strong>
                            <p class="text-muted">
                                {{ $user->email }}
                            </p>
                            @if(isset($user->department))
                                <hr>
                                <strong><i class="fas fa-users-cog mr-1"></i>Department</strong>
                                <p class="text-muted">
                                    {{ $user->department->name }}
                                </p>
                            @endif
                            <hr>
                            <strong>
                                <i class="fas fa-list mr-1"></i>
                                Projects
                                <span class="badge badge-warning">
                                    @if(isset($user->department) && $user->department->slug === 'management')
                                        {{ $user->manager_projects_count }}
                                    @else
                                        {{ $user->projects_count }}
                                    @endif
                                </span>
                            </strong>
                            <a href="{{ route('users.projects', $user) }}" class="float-right">
                                <i class="fas fa-arrow-circle-right mr-1"></i>
                            </a>
                            <hr>
                            <strong>
                                <i class="fas fa-clipboard-list mr-1"></i>
                                Issues
                                <span class="badge badge-warning">{{ $user->issues_count }}</span>
                            </strong>
                            <a href="{{ route('users.issues', $user) }}" class="float-right">
                                <i class="fas fa-arrow-circle-right mr-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

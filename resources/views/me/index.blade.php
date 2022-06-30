@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>My Profile</h1>
                </div>
            </div>
        </div>
    </section>
    @if(session()->has('successMessage'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session()->get('successMessage') }}
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
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
                            <h3 class="card-title">About Me</h3>
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
                                My Projects
                                <span class="badge badge-warning">
                                    @if(isset($user->department) && $user->department->slug === 'management')
                                        {{ $user->manager_projects_count }}
                                    @else
                                        {{ $user->projects_count }}
                                    @endif
                                </span>
                            </strong>
                            <a href="{{ route('me.projects') }}" class="float-right">
                                <i class="fas fa-arrow-circle-right mr-1"></i>
                            </a>
                            <hr>
                            <strong>
                                <i class="fas fa-clipboard-list mr-1"></i>
                                My Issues
                                <span class="badge badge-warning">{{ $user->issues_count }}</span>
                            </strong>
                            <a href="{{ route('me.issues') }}" class="float-right">
                                <i class="fas fa-arrow-circle-right mr-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-8 card card-primary card-outline">
                    <label class="p-3" for="personal_data_form"><h4>Change Personal Data</h4></label>
                    <form method="post" enctype="multipart/form-data" action="{{ route('me.update') }}"
                          id="personal_data_form">
                        @csrf
                        @method('patch')
                        <div class="px-3 row">
                            <div class="col-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       placeholder="Change your First Name" value="{{ $user->first_name }}">
                                @error('first_name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       placeholder="Change your Last Name" value="{{ $user->last_name }}">
                                @error('last_name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col px-3 pt-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="Change your Email" value="{{ $user->email }}">
                            @error('email')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col px-3 pt-2">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            @error('avatar')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <button type="submit" class="btn btn-outline-primary">Submit Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row pl-2">
                <div class="col card card-primary card-outline">
                    <label class="p-3" for="password_form"><h4>Change Password</h4></label>
                    <form method="post" enctype="multipart/form-data" action="{{ route('me.update.password') }}"
                          id="password_form">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-5 px-3 pb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-5 px-3 pb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation">
                                @error('password_confirmation')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-2 px-3 pb-3">
                                <button type="submit" class="btn btn-outline-primary">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

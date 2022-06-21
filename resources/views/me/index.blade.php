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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- User Card -->
                <div class="col-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset(auth()->user()->avatar) }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </h3>
                            <p class="text-muted text-center">{{ auth()->user()->position->title }}</p>
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
                                {{ auth()->user()->email }}
                            </p>
                            @if(isset(auth()->user()->department))
                                <hr>
                                <strong><i class="fas fa-users-cog mr-1"></i>Department</strong>
                                <p class="text-muted">
                                    {{ auth()->user()->department->name }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-6 card card-primary card-outline">
                    <form method="post" enctype="multipart/form-data" action="{{ route('me.update') }}">
                        @csrf
                        @method('patch')
                        <div class="p-3 row">
                            <div class="col-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       placeholder="Change your First Name">
                                @error('first_name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       placeholder="Change your Last Name">
                                @error('last_name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col px-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="Change your Email">
                            @error('email')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col p-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Change your Password">
                            @error('password')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col px-3">
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
        </div>
    </section>
@endsection

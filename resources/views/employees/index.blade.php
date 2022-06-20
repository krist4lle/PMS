@extends('layouts.app')
@section('content')
    <!-- CEO -->
    <div class="container-fluid pt-4">
        <div class="row justify-content-center">
            <div class="col-3">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-info">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                 src="{{ asset($ceo->avatar) }}" alt="User Avatar">
                        </div>
                        <h4 class="widget-user-desc">
                            {{ $ceo->first_name }}
                            {{ $ceo->last_name }}
                        </h4>
                        <p class="widget-user-desc">
                            {{ $ceo->position->title }}
                            <a class="float-right text-white" href="{{ route('profile.index', $ceo->id) }}">Profile link <i
                                    class="nav-icon fas fa-link"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Heads -->
    <div class="container-fluid pt-4">
        <div class="row align-items">
            <!-- Head of Management Department -->
            <div class="card bg-info col-3">
                <div class="card-header align-items-center row">
                    <div class="col">{{ $headManagement->position->title }}</div>
                    <div class="col-1">
                    <a class="text-white" href="{{ route('profile.index', $headManagement->id) }}">
                        <i class="nav-icon fas fa-id-card float-right p-2"></i>
                    </a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col">
                        <img class="col-12"
                             src="{{ asset($headManagement->avatar) }}" alt="User Avatar">
                    </div>
                    <div class="pt-3 col-8">
                        <h3>{{ $headManagement->first_name }} {{ $headManagement->last_name }}</h3>
                    </div>
                </div>
            </div>
            <!-- Art Director -->
            <div class="card bg-info col-3">
                <div class="card-header align-items-center row">
                    <div class="col">{{ $artDirector->position->title }}</div>
                    <div class="col-1">
                        <a class="text-white" href="{{ route('profile.index', $artDirector->id) }}">
                            <i class="nav-icon fas fa-id-card float-right p-2"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col">
                        <img class="col-12"
                             src="{{ asset($artDirector->avatar) }}" alt="User Avatar">
                    </div>
                    <div class="pt-3 col-8">
                        <h3>{{ $artDirector->first_name }} {{ $artDirector->last_name }}</h3>
                    </div>
                </div>
            </div>
            <!-- Head of Frontend Department -->
            <div class="card bg-info col-3">
                <div class="card-header align-items-center row">
                    <div class="col">{{ $headFrontend->position->title }}</div>
                    <div class="col-1">
                        <a class="text-white" href="{{ route('profile.index', $headFrontend->id) }}">
                            <i class="nav-icon fas fa-id-card float-right p-2"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col">
                        <img class="col-12"
                             src="{{ asset($headFrontend->avatar) }}" alt="User Avatar">
                    </div>
                    <div class="pt-3 col-8">
                        <h3>{{ $headFrontend->first_name }} {{ $headFrontend->last_name }}</h3>
                    </div>
                </div>
            </div>
            <!-- Head of Backend Department -->
            <div class="card bg-info col-3">
                <div class="card-header align-items-center row">
                    <div class="col">{{ $headBackend->position->title }}</div>
                    <div class="col-1">
                        <a class="text-white" href="{{ route('profile.index', $headBackend->id) }}">
                            <i class="nav-icon fas fa-id-card float-right p-2"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col">
                        <img class="col-12"
                             src="{{ asset($headBackend->avatar) }}" alt="User Avatar">
                    </div>
                    <div class="col-8">
                        <h3>{{ $headBackend->first_name }} {{ $headBackend->last_name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Employees -->
    <div class="container-fluid pt-2">
        <div class="row align-items">
            <!-- Management -->
            <div class="col-3">
                @foreach($users->where('parent_id', 2) as $user)
                    <div class="info-box">
                        <span class="info-box-icon bg-transparent">
                            <img src="{{ $user->avatar }}" alt="user_avatar">
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-number">
                                <div class="row justify-content-between">
                                <h4 class="pl-2">
                                   {{ $user->first_name }} {{ $user->last_name }}
                                </h4>
                                <a href="{{ route('profile.index', $user->id) }}">
                                    <i class="nav-icon fas fa-id-card float-right p-2"></i>
                                </a>
                                    </div>
                            </span>
                            <p>{{ $user->position->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Design -->
            <div class="col-3">
                @foreach($users->where('parent_id', 3) as $user)
                    <div class="info-box">
                        <span class="info-box-icon bg-transparent">
                            <img src="{{ $user->avatar }}" alt="user_avatar">
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-number">
                                <div class="row justify-content-between">
                                <h4 class="pl-2">
                                   {{ $user->first_name }} {{ $user->last_name }}
                                </h4>
                                <a href="{{ route('profile.index', $user->id) }}">
                                    <i class="nav-icon fas fa-id-card float-right p-2"></i>
                                </a>
                                    </div>
                            </span>
                            <p>{{ $user->position->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Frontend -->
            <div class="col-3">
                @foreach($users->where('parent_id', 4) as $user)
                    <div class="info-box">
                        <span class="info-box-icon bg-transparent">
                            <img src="{{ $user->avatar }}" alt="user_avatar">
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-number">
                                <div class="row justify-content-between">
                                <h4 class="pl-2">
                                   {{ $user->first_name }} {{ $user->last_name }}
                                </h4>
                                <a href="{{ route('profile.index', $user->id) }}">
                                    <i class="nav-icon fas fa-id-card float-right p-2"></i>
                                </a>
                                    </div>
                            </span>
                            <p>{{ $user->position->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Backend -->
            <div class="col-3">
                @foreach($users->where('parent_id', 5) as $user)
                    <div class="info-box">
                        <span class="info-box-icon bg-transparent">
                            <img src="{{ $user->avatar }}" alt="user_avatar">
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-number">
                                <div class="row justify-content-between">
                                <h4 class="pl-2">
                                   {{ $user->first_name }} {{ $user->last_name }}
                                </h4>
                                <a href="{{ route('profile.index', $user->id) }}">
                                    <i class="nav-icon fas fa-id-card float-right p-2"></i>
                                </a>
                                    </div>
                            </span>
                            <p>{{ $user->position->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

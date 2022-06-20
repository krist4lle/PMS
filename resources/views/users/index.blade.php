@extends('layouts.app')
@section('content')
    <!-- CEO -->
    <div class="container-fluid pt-4">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h2 class="widget-user-desc">
                            {{ $ceo->first_name }}
                            {{ $ceo->last_name }}
                        </h2>
                        <h5 class="widget-user-desc">
                            {{ $ceo->position->title }}
                        </h5>
                    </div>
                    <div class="widget-user-image pt-2">
                        <img class="img-circle elevation-2" src="{{ asset($ceo->avatar) }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col-sm-4 border-right border-left">
                                <div class="description-block">
                                    <span class="description-text">
                                        <a href="#">
                                            Profile
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Heads -->
    <div class="container-fluid pt-4">
        <div class="row align-items">
            <!-- Head of Management Department -->
            <div class="col-3">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-olive">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                 src="{{ asset($headManagement->avatar) }}" alt="User Avatar">
                        </div>
                        <h4 class="widget-user-desc">
                            {{ $headManagement->first_name }}
                            {{ $headManagement->last_name }}
                        </h4>
                        <p class="widget-user-desc">
                            {{ $headManagement->position->title }}
                        </p>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Subordinates <span class="float-right badge bg-secondary">
                                        {{ $users->where('parent_id', 2)->count() }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Art Director -->
            <div class="col-3">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-teal height">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                 src="{{ asset($artDirector->avatar) }}" alt="User Avatar">
                        </div>
                        <h4 class="widget-user-desc">
                            {{ $artDirector->first_name }}
                            {{ $artDirector->last_name }}
                        </h4>
                        <p class="widget-user-desc">
                            {{ $artDirector->position->title }}
                        </p>
                        <br>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Subordinates <span class="float-right badge bg-secondary">
                                        {{ $users->where('parent_id', 3)->count() }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Head of Frontend Department -->
            <div class="col-3">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-success">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                 src="{{ asset($headFrontend->avatar) }}" alt="User Avatar">
                        </div>
                        <h4 class="widget-user-desc">
                            {{ $headFrontend->first_name }}
                            {{ $headFrontend->last_name }}
                        </h4>
                        <p class="widget-user-desc">
                            {{ $headFrontend->position->title }}
                        </p>
                        <br>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Subordinates <span class="float-right badge bg-secondary">
                                        {{ $users->where('parent_id', 4)->count() }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Head of Backend Department -->
            <div class="col-3">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-purple">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                 src="{{ asset($headBackend->avatar) }}" alt="User Avatar">
                        </div>
                        <h4 class="widget-user-desc">
                            {{ $headBackend->first_name }}
                            {{ $headBackend->last_name }}
                        </h4>
                        <p class="widget-user-desc">
                            {{ $headBackend->position->title }}
                        </p>
                        <br>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Subordinates <span class="float-right badge bg-secondary">
                                        {{ $users->where('parent_id', 5)->count() }}
                                    </span>
                                </a>
                            </li>
                        </ul>
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
                                <a href="#">
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
                                <a href="#">
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
                                <a href="#">
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
                                <a href="#">
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

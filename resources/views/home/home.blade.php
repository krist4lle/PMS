@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-4">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">
                            {{ $ceo->first_name }}
                            {{ $ceo->last_name }}
                        </h3>
                        <h5 class="widget-user-desc">
                            {{ $ceo->position->title }}
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ asset($ceo->avatar) }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col-sm-4 border-right border-left">
                                <div class="description-block">
                                    <h5 class="description-header">0</h5>
                                    <span class="description-text">Projects</span>
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
                        <h3 class="widget-user-username">
                            {{ $headManagement->first_name }}
                            {{ $headManagement->last_name }}
                        </h3>
                        <h5 class="widget-user-desc">
                            {{ $headManagement->position->title }}
                        </h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Projects <span class="float-right badge bg-primary">31</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Completed Projects <span class="float-right badge bg-success">12</span>
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
                        <h3 class="widget-user-username">
                            {{ $artDirector->first_name }}
                            {{ $artDirector->last_name }}
                        </h3>
                        <h5 class="widget-user-desc">
                            {{ $artDirector->position->title }}
                        </h5>
                        <br>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Projects <span class="float-right badge bg-primary">31</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Completed Projects <span class="float-right badge bg-success">12</span>
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
                        <h3 class="widget-user-username">
                            {{ $headFrontend->first_name }}
                            {{ $headFrontend->last_name }}
                        </h3>
                        <h5 class="widget-user-desc">
                            {{ $headFrontend->position->title }}
                        </h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Projects <span class="float-right badge bg-primary">31</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Completed Projects <span class="float-right badge bg-success">12</span>
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
                        <h3 class="widget-user-username">
                            {{ $headBackend->first_name }}
                            {{ $headBackend->last_name }}
                        </h3>
                        <h5 class="widget-user-desc">
                            {{ $headBackend->position->title }}
                        </h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Projects <span class="float-right badge bg-primary">31</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Completed Projects <span class="float-right badge bg-success">12</span>
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
            <div class="card col-3">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $headManagement->department->name }} employees
                    </h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->where('department_id', 1) as $user)
                        <tr>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->position->title }}</td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- Design -->
            <div class="card col-3">
                <div class="card-header">
                    <h3 class="card-title">{{ $artDirector->department->name }} employees</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->where('department_id', 2) as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->position->title }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- Frontend -->
            <div class="card col-3">
                <div class="card-header">
                    <h3 class="card-title">{{ $headFrontend->department->name }} employees</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->where('department_id', 3) as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->position->title }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- Backend -->
            <div class="card col-3">
                <div class="card-header">
                    <h3 class="card-title">{{ $headBackend->department->name }} employees</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users->where('department_id', 4) as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->position->title }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add a new Team member</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form method="post" enctype="multipart/form-data" class="row" action="{{ route('users.store') }}">
                @csrf
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Personal Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           value="{{ old('first_name') }}" placeholder="Enter First Name">
                                </div>
                                <div class="col-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           value="{{ old('last_name') }}" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email"
                                       placeholder="Enter Email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password"
                                       placeholder="Enter Password" name="password" value="{{ old('password') }}">
                            </div>
                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                                <div>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Company Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department">
                                    <option>Choose Department</option>
                                    @foreach($departments as $department)
                                        <option>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <select class="form-control" name="position">
                                    <option>Choose Position</option>
                                    @foreach($positions as $position)
                                        <option>{{ $position->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Supervisor</label>
                                <select class="form-control" name="parent">
                                    <option>Choose Supervisor</option>
                                    @foreach($supervisors as $supervisor)
                                        <option>
                                            {{ $supervisor->first_name }}
                                            {{ $supervisor->last_name }}:
                                            {{ $supervisor->position->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

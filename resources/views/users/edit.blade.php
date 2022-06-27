@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col row justify-content-between">
                    <div>
                        <h1>
                            Edit <em>{{ $user->first_name }} {{ $user->last_name }}</em>
                        </h1>
                    </div>
                    <div>
                        <a href="{{ route('users.index') }}" type="button" class="btn btn-outline-secondary">To Users</a>
                    </div>
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
        <div class="container-fluid">
            <form method="post" action="{{ route('users.update', $user) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col card card-primary card-outline">
                        <label class="p-3"><h4>User Data</h4></label>
                        <div class="px-3 row">
                            <div class="col-6">
                                <label for="first_name" class="form-label">First Name</label>
                                @error('first_name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{ $user->first_name }}">
                            </div>
                            <div class="col-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                @error('last_name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value="{{ $user->last_name }}">
                            </div>
                        </div>
                        <div class="px-3 pt-2 row align-items-end">
                            <div class="col-6">
                                <label for="first_name" class="form-label">Email</label>
                                @error('email')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ $user->email }}">
                            </div>
                            <div class="col-5">
                                <label for="avatar" class="form-label">Avatar</label>
                                @error('avatar')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                            <div class="col-1">
                                <img src="{{ asset($user->avatar) }}" alt="userAvatar" class="col-9">
                            </div>
                        </div>
                        <div class="px-3 pt-2 row">
                            <div class="col-6">
                                <label for="department" class="form-label">Department</label>
                                @error('department')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <select name="department" id="department" class="form-control">
                                        <option value="">Choose Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->name }}"
                                            @if(isset($user->department))
                                                {{ $user->department->name == $department->name ? 'selected' : '' }}
                                                @endif>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="position" class="form-label">Position</label>
                                @error('position')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                @if(isset($errors->getBag('default')->toArray()[0]))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        {{ $errors->getBag('default')->toArray()[0][0] }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <select name="position" id="position" class="form-control">
                                        <option>Choose Position</option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->title }}"
                                                {{ $user->position->title == $position->title ? 'selected' : '' }}>
                                                {{ $position->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 row">
                            <div class="col-6">
                                <label for="parent" class="form-label">Supervisor</label>
                                @error('position')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <select name="parent" id="parent" class="form-control">
                                        <option value="">Choose Supervisor</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->position->title }}"
                                            @if(isset($user->parent->position))
                                                {{ $parent->position->title == $user->parent->position->title ? 'selected' : '' }}
                                                @endif>
                                                {{ $parent->position->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                        <div class="col pb-3 pl-3">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col card card-primary card-outline">
                        <label class="p-3" for="password_form"><h4>Change Password</h4></label>
                        @csrf
                        @method('put')
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
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

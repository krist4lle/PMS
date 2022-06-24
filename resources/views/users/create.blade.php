@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col row justify-content-between">
                    <div>
                        <h1>Create a new User</h1>
                    </div>
                    <div>
                        <a href="{{ route('users.index') }}" type="button" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col card card-primary card-outline">
                    <label class="p-3" for="personal_data_form"><h4>User Data</h4></label>
                    <form method="post" action="{{ route('users.store') }}"
                          id="personal_data_form">
                        @csrf
                        <div class="px-3 row">
                            <div class="col-6">
                                <label for="first_name" class="form-label">First Name</label>
                                @error('first_name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       placeholder="Enter First Name" value="{{ old('first_name') }}">
                            </div>
                            <div class="col-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                @error('last_name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       placeholder="Enter Last Name" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        <div class="col-6 pl-3 pt-2">
                            <label for="gender" class="form-label">Gender</label>
                            <div class="form-group">
                                <select name="gender" id="gender" class="form-control">
                                    <option {{ old('gender') == 'male' ? 'selected' : '' }} value="male">Male</option>
                                    <option {{ old('gender') == 'female' ? 'selected' : '' }} value="female">Female
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="px-3 row">
                            <div class="col-6">
                                <label for="password" class="form-label">Password</label>
                                @error('password')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="col-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                @error('password_confirmation')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation">
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
                                        <option>Choose Department</option>
                                        @foreach($departments as $department)

                                                <option value="{{ $department->name }}"
                                                    {{ old('department') == $department->name ? 'selected' : '' }}>
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
                                                    {{ old('position') == $position->title ? 'selected' : '' }}>
                                                    {{ $position->title }}
                                                </option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col p-3">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col row justify-content-between">
                    <div>
                        <h1>Create a new Project</h1>
                    </div>
                    <div>
                        <a href="{{ route('projects.index') }}" type="button" class="btn btn-outline-secondary">
                            To Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col card card-primary card-outline">
                    <label class="p-3" for="personal_data_form"><h4>Project Data</h4></label>
                    <form method="post" action="{{ route('projects.store') }}"
                          id="personal_data_form">
                        @csrf
                        <div class="px-3 row">
                            <div class="col-6">
                                <label for="title" class="form-label">Project's Title *</label>
                                @error('title')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Enter Title" value="{{ old('title') }}">
                            </div>
                            <div class="col-6">
                                <label for="title" class="form-label">Deadline</label>
                                <input type="date" class="form-control" id="deadline" name="deadline"
                                       placeholder="Enter Title" value="{{ old('deadline') }}">
                            </div>
                        </div>
                        <div class="px-3 pt-2 row">
                            <div class="form-floating col-12">
                                <label for="description" class="form-label">Description *</label>
                                @error('description')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <textarea name="description" id="description"
                                          class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="px-3 pt-2 row">
                            <div class="col-6">
                                <label for="client" class="form-label">Client *</label>
                                @error('client')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <select name="client" id="client" class="form-control">
                                        <option value="">Choose Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}"
                                                {{ old('client') == $client->id ? 'selected' : '' }}>
                                                {{ $client->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="manager" class="form-label">Project Manager *</label>
                                @error('manager')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <select name="manager" id="manager" class="form-control">
                                        <option value="">Choose Project Manager</option>
                                        @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}"
                                                {{ old('manager') == $manager->id ? 'selected' : '' }}>
                                                {{ $manager->first_name }} {{ $manager->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Workers *</label>
                                        @error('workers')
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <select name="workers[]" class="duallistbox" multiple="multiple" style="display: none;">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ is_array(old('workers')) && in_array($user->id, old('workers')) ? 'selected' : '' }}>
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                    : "{{ $user->position->title }}"
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col px-3 pb-3">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

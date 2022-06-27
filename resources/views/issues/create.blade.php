@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col row justify-content-between">
                    <div>
                        <h1>Create a new Issue</h1>
                    </div>
                    <div>
                        <a href="" type="button" class="btn btn-outline-secondary">
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
                    <label class="p-3" for="personal_data_form"><h4>Issue Data</h4></label>
                    <form method="post" action="{{ route('issues.store') }}"
                          id="personal_data_form">
                        @csrf
                        <div class="px-3 row">
                            <div class="col-6">
                                <label for="title" class="form-label">Issue's Title</label>
                                @error('title')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Enter Title" value="{{ old('title') }}">
                            </div>
                            <div class="col-6"></div>
                        </div>
                        <div class="px-3 pt-2 row">
                            <div class="form-floating col-12">
                                <label for="description" class="form-label">Description</label>
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
                                <label for="assignee" class="form-label">Assignee</label>
                                @error('assignee')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <select name="assignee" id="assignee" class="form-control">
                                        <option value="">Choose Assignee</option>
                                        @foreach($assignees as $assignee)
                                            <option value="{{ $assignee->id }}"
                                            {{ $assignee->id == old('assignee') ? 'selected' : '' }}>
                                                {{ $assignee->first_name }} {{ $assignee->last_name }}:
                                                {{ $assignee->position->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="project" class="form-label">Project</label>
                                @error('project')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="form-group">
                                    <select name="project" id="project" class="form-control">
                                        <option value="">Choose Project</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->title }}"
                                                {{ $project->title == old('project') ? 'selected' : '' }}>
                                                {{ $project->title }}
                                            </option>
                                        @endforeach
                                    </select>
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

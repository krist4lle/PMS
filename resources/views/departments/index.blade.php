@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Departments</h1>
                </div>
            </div>
        </div>
    </section>
    @if(session()->has('errorMessage'))
        <div class="alert alert-danger mt-2" role="alert">
            {{ session()->get('errorMessage') }}
        </div>
    @endif
    @error('name')
    <div class="alert alert-danger mt-2" role="alert">
        {{ $message }}
    </div>
    @enderror
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">Department Name</th>
                        <th style="width: 20%">Employees</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->users_count }}</td>
                            <td class="project-actions text-right row">
                                @canany(['update', 'delete'], $department)
                                    <a class="btn btn-info btn-sm mx-2"
                                       href="{{ route('departments.edit', $department) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('departments.destroy', $department) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm mx-2" type="submit">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                @endcanany
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Users</h1>
                </div>
            </div>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-info mt-2">Create a new User</a>
    </section>
    @if(session()->has('success'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('errorMessage'))
        <div class="alert alert-danger mt-2" role="alert">
            {{ session()->get('errorMessage') }}
        </div>
    @endif
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">User Name</th>
                        <th style="width: 20%">Position</th>
                        <th style="width: 20%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->position->title }}</td>
                            <td class="project-actions text-right row">
                                <a class="btn btn-primary btn-sm mx-2" href="{{ route('users.show', $user) }}">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm mx-2" href="{{ route('users.edit', $user) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <button class="btn btn-danger btn-sm mx-2" data-toggle="modal"
                                        data-target="#ModalDelete{{ $user->id }}" type="submit">
                                    <i class="fas fa-fire"></i>
                                    Fire User
                                </button>
                            </td>
                        </tr>
                        @include('users.modal.delete')
                    @endforeach
                    </tbody>
                </table>
                {{ $users->withQueryString() }}
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Clients</h1>
                </div>
            </div>
        </div>
        <a href="{{ route('clients.create') }}" class="btn btn-info mt-2">Add a new Client</a>
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
                        <th style="width: 10%">Client's Title</th>
                        <th style="width: 30%">About</th>
                        <th style="width: 5%">Projects</th>
                        <th style="width: 20%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->title }}</td>
                            <td>{{ $client->description }}</td>
                            <td>{{ $client->projects_count }}</td>
                            <td class="project-actions text-right row">
                                <a class="btn btn-primary btn-sm mx-2" href="{{ route('clients.show', $client) }}">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm mx-2" href="{{ route('clients.edit', $client) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <form action="{{ route('clients.destroy', $client) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm mx-2" type="submit">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $clients->withQueryString() }}
            </div>
        </div>
    </section>
@endsection

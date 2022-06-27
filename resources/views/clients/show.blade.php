@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col justify-content-between">
                    <h1>Client</h1>
                </div>
                <div>
                    <a href="{{ route('clients.index') }}" type="button" class="btn btn-outline-secondary">
                        To Clients
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> {{ $client->title }}
                        <small class="float-right">
                            Since:
                            <em>{{ \Carbon\Carbon::make($client->created_at)->format('d-F-Y') }}</em>
                        </small>
                    </h4>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <strong>Contacts</strong>
                    <address>
                        Email<br>
                        <em>{{ $client->email }}</em><br>
                        Phone<br>
                        <em>{{ $client->phone }}</em>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <h4>Projects</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Title</th>
                            <th style="width: 60%">About Project</th>
                            <th>Manager</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($client->projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->manager->first_name }} {{ $project->manager->last_name }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm mx-2"
                                       href="{{ route('projects.show', $project) }}">
                                        <i class="fas fa-folder"></i>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection

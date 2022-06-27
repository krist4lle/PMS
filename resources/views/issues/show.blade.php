@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col justify-content-between">
                    <h1>Issue: {{ $issue->title }}</h1>
                </div>
                <div>
                    @if(empty($issue->finished_at))
                        <form action="{{ route('issues.status', $issue) }}" method="post">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-primary">
                                @if($issue->status->status === 'new')
                                    Accept
                                @else
                                    Close
                                @endif
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @if(session()->has('success'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <section>
        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <h4>
                        Description
                        <small class="float-right">
                            Status: <span class="badge badge-info">{{ $issue->status->status }}</span>
                        </small>
                    </h4>

                </div>
                <div class="col-6">
                    <p>
                        {{ $issue->description }}
                    </p>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-4 invoice-col">
                    <address>
                        <b>Created</b><br>
                        <em>{{ $issue->created_at }}</em><br>
                        <b>Updated</b><br>
                        <em>{{ $issue->updated_at }}</em><br>
                        <b>Closed</b><br>
                        @if(empty($issue->finished_at))
                            <em>N/A</em>
                        @else
                            <em>{{ $issue->finished_at }}</em>
                        @endif
                    </address>
                </div>
                <div class="col-4 invoice-col">
                    <address>
                        <b>Project</b><br>
                        <em>
                            {{ $project->title }}
                            <a href="{{ route('projects.show', $project) }}">
                                <i class="nav-icon fas fa-arrow-circle-right"></i>
                            </a>
                        </em><br>
                        <b>Assignee</b><br>
                        <em>
                            {{ $assignee->first_name }} {{ $assignee->last_name }}:
                            {{ $assignee->position->title }}
                        </em><br>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <h4>Comments</h4>
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

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a class="btn btn-primary btn-sm mx-2"
                                   href="">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

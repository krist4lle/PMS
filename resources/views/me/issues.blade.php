@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="col row justify-content-between">
                <div>
                    <h1>My Issues</h1>
                </div>
                <div>
                    <a href="{{ route('me.index') }}" type="button" class="btn btn-outline-secondary">
                        My Profile
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 10%">Issue</th>
                        <th style="width: 40%">Description</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 20%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($issues as $issue)
                        <tr>
                            <td>{{ $issue->title }}</td>
                            <td>{{ $issue->description }}</td>
                            <td>
                                @if($issue->status->slug === 'new')
                                    <span class="badge badge-danger">{{ $issue->status->name }}</span>
                                @elseif($issue->status->slug === 'done')
                                    <span class="badge badge-success">{{ $issue->status->name }}</span>
                                @else
                                    <span class="badge badge-warning">{{ $issue->status->name }}</span>
                                @endif
                            </td>
                            <td class="text-right row">
                                <a class="btn btn-primary btn-sm mx-2" href="{{ route('issues.show', $issue) }}">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
                                @if(empty($issue->finished_at))
                                    <form action="{{ route('issues.status', $issue) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="btn btn-info btn-sm mx-2">
                                            @if($issue->status->slug === 'new')
                                                Accept Issue
                                            @elseif($issue->status->slug === 'in_progress')
                                                Send to review
                                            @else
                                                Close Issue
                                            @endif
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('content')
    <div class="row justify-content-center pt-5">
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    {{ $user->position->title }}
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b>{{ $user->first_name }} {{ $user->last_name }}</b></h2>
                            @if($user->department != null)
                            <p class="text-muted text-sm"><b>Department: </b>{{ $user->department->name }}</p>
                            @endif
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clipboard-check"></i></span>
                                    Since: {{ \Carbon\Carbon::make($user->created_at)->toFormattedDateString() }}
                                </li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email:
                                    {{ $user->email }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset($user->avatar) }}" alt="user-avatar" class="img-circle img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{ route('employees.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-circle-left"></i> Back to Team
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

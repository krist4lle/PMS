@extends('layouts.app')
@section('content')
    <div class="row justify-content-center pt-5">
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    <h5>Change Position Title</h5>
                </div>
                <div class="card-body pt-0">
                    <form method="post" action="{{ route('positions.update', $position) }}">
                        @csrf
                        @method('put')
                        <div>
                            @error('title')
                            <div class="alert alert-danger mt-2" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                            <input type="text" class="form-control" value="{{ $position->title }}"
                                   name="title">
                            <br>
                            <button type="submit" class="btn btn-primary">Change Position</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="{{ route('positions.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-circle-left"></i>
                            Back to Positions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

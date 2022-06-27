@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col row justify-content-between">
                    <div>
                        <h1>
                            Edit a Client: <em>{{ $client->title }}</em>
                            <a href="{{ route('clients.show', $client) }}">
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </h1>
                    </div>
                    <div>
                        <a href="{{ route('clients.index') }}" type="button" class="btn btn-outline-secondary">
                            To Clients
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(session()->has('success'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col card card-primary card-outline">
                    <label class="p-3" for="personal_data_form"><h4>Client Data</h4></label>
                    <form method="post" action="{{ route('clients.update', $client) }}"
                          id="personal_data_form">
                        @csrf
                        @method('put')
                        <div class="px-3 row">
                            <div class="col-6">
                                <label for="title" class="form-label">Client's Title</label>
                                @error('title')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Enter Title" value="{{ $client->title }}">
                            </div>
                            <div class="col-6"></div>
                        </div>
                        <div class="px-3 pt-2 row">
                            <div class="form-floating col-12">
                                <label for="description" class="form-label">About</label>
                                @error('description')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <textarea name="description" id="description"
                                          class="form-control">{{ $client->description }}</textarea>
                            </div>
                        </div>
                        <div class="px-3 pt-2 row">
                            <div class="col-6">
                                <label for="email" class="form-label">Email</label>
                                @error('email')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter Email" value="{{ $client->email }}">
                            </div>
                            <div class="col-6">
                                <label for="phone" class="form-label">Phone number</label>
                                @error('phone')
                                <div class="alert alert-danger mt-2" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="tel" class="form-control" id="phone" name="phone"
                                       placeholder="Enter Phone number without '+'"
                                       value="{{ ltrim($client->phone, '+') }}">
                            </div>
                        </div>
                        <div class="col p-3">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('content')
    <div class="row pt-5">
        @foreach($departments as $department)
            <div class="col-3">
                <div class="card h-100">
                    <img src="" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

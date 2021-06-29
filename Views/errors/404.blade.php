@extends('layouts.auth')

@section('title', '404 Not Found')

@section('content')
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="p-v-30">
                <h1 class="font-weight-semibold display-1 text-primary lh-1-2">404</h1>
                <h2 class="font-weight-light font-size-30">Whoops! Looks like you got lost</h2>
                <p class="lead m-b-30">We couldn't find what you were looking for.</p>
                <a href="javascript:void(0)" class="btn btn-primary btn-tone go-back">Go Back</a>
            </div>
        </div>
        <div class="col-md-6 m-l-auto">
            <img class="img-fluid" src="{{ asset('img/404.png') }}" alt="">
        </div>
    </div>
@endsection
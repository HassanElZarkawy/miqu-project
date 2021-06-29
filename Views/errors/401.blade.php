@extends('layouts.auth')

@section('title', '401 Unauthorized')

@section('content')
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="p-v-30">
                <h1 class="font-weight-semibold display-1 text-primary lh-1-2 font-size-60">401 Unauthorized</h1>
                <h2 class="font-weight-light font-size-30">Whoops! You need to be logged in to access this area.</h2>
                <a href="{{ route('auth.login') }}" class="btn btn-primary btn-tone">Login</a>
            </div>
        </div>
        <div class="col-md-6 m-l-auto">
            <img class="img-fluid" src="{{ asset('img/401.png') }}" alt="Unauthorized">
        </div>
    </div>
@endsection
@extends('layouts.auth')

@section('title', '403 Forbidden')

@section('content')
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="p-v-30">
                <h1 class="font-weight-semibold display-1 text-primary lh-1-2 font-size-60">403 Forbidden</h1>
                <h2 class="font-weight-light font-size-30">Whoops! You're not allowed to access this.</h2>
                <a href="javascript:void(0)" class="btn btn-primary btn-tone go-back">Go Back</a>
            </div>
        </div>
        <div class="col-md-6 m-l-auto">
            <img class="img-fluid" src="@asset('img/403.png')" alt="">
        </div>
    </div>
@endsection
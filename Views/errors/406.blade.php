@extends('layouts.auth')

@section('title', '404 Not Acceptable')

@section('content')
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="p-v-30">
                <h1 class="font-weight-semibold display-1 text-primary lh-1-2">406</h1>
                <h2 class="font-weight-light font-size-30">Whoops! The server didn't find any content that conforms to the criteria given by you.</h2>
                <a href="javascript:void(0)" class="btn btn-primary btn-tone go-back">Go Back</a>
            </div>
        </div>
    </div>
@endsection
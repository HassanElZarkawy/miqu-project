@extends('layouts.auth')

@section('title', __('Lock your Account'))

@section('content')
    <div class="row align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-t-20">Waiting for you, {{ $user->name }}!</h2>
                    <p class="m-b-30">Please type in your password</p>
                    <form method="post" action="{{ route('auth.login') }}">
                        {!! csrf() !!}
                        <input type="hidden" value="{{$user->username}}" name="email">

                        <div class="form-group">
                            <label class="font-weight-semibold" for="password">Password: </label>
                            <div class="input-affix w-100">
                                <i class="prefix-icon anticon anticon-lock"></i>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        @if( isset($errors) )
                            @foreach($errors as $error)
                                <p class="text-danger mt-2">{{ $error }}</p>
                            @endforeach
                        @endif
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="offset-md-1 col-md-6 d-none d-md-block">
            <img class="img-fluid" src="@asset('img/password-lock.png')" alt="Account Locked">
        </div>
    </div>
@endsection

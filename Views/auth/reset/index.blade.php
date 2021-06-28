@extends('layouts.auth')

@section('title', __('Reset Password'))

@section('content')
    <div class="row align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-t-20">Hi, {{ $user->name }}!</h2>
                    <p class="m-b-30">Please type in your password</p>
                    <form method="post" action="{{ string(route('auth.reset-password'))->replace('{token}', $token) }}">
                        {!! csrf() !!}
                        <div class="form-group">
                            <label class="font-weight-semibold" for="password">Password: </label>
                            <div class="input-affix w-100">
                                <i class="prefix-icon anticon anticon-lock"></i>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold" for="confirm-password">Confirm Password: </label>
                            <div class="input-affix w-100">
                                <i class="prefix-icon anticon anticon-lock"></i>
                                <input type="password" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
                            </div>
                        </div>
                        @if( isset($errors) )
                            @foreach($errors as $error)
                                <p class="text-danger mt-2">{{ $error }}</p>
                            @endforeach
                        @endif
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="btn btn-primary">Save New Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="offset-md-1 col-md-6 d-none d-md-block">
            <img class="img-fluid" src="@asset('img/reset-password.png')" alt="I forgot my password">
        </div>
    </div>
@endsection
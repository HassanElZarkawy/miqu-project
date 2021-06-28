@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="row align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-t-20">Sign In</h2>
                    <p class="m-b-30">Enter your credential to get access</p>
                    <form method="post" action="{{ route('auth.login') }}">
                        {!! csrf() !!}
                        <div class="form-group">
                            <label class="font-weight-semibold" for="email">Username: </label>
                            <div class="input-affix">
                                <i class="prefix-icon anticon anticon-user"></i>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email or Username" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold" for="password">Password:</label>
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-lock"></i>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <a class="float-right font-size-13 text-muted" href="{{ route('auth.forgot-password') }}">Forget Password?</a>

                        </div>
                        <div class="form-group pt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="font-size-13 text-muted">
                                    Don't have an account?
                                    <a class="small" href=""> Signup</a>
                                </span>
                                <button class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="offset-md-1 col-md-6 d-none d-md-block">
            <img class="img-fluid" src="@asset('img/login.png')" alt="">
        </div>
    </div>
@endsection

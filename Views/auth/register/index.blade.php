@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="row align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="m-t-20">Create an account</h2>
                    <p class="m-b-30">Fill in your details</p>
                    @if(isset($errors))
                        <ul class="m-4">
                            @foreach($errors as $error)
                                <li class="text-danger"> <small>{{ $error }}</small> </li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="post" action="{{ route('auth.register') }}">
                        {!! csrf() !!}
                        <div class="form-group">
                            <label class="font-weight-semibold" for="name">Name: </label>
                            <div class="input-affix">
                                <i class="prefix-icon anticon anticon-user"></i>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Your full name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold" for="username">Username: </label>
                            <div class="input-affix">
                                <i class="prefix-icon anticon anticon-user"></i>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold" for="email">Email: </label>
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
                        </div>
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="font-size-14 text-muted">
                                    Already have account?
                                    <a class="small" href="{{ route( 'auth.login' ) }}"> Login</a>
                                </span>
                                <button class="btn btn-primary">Create Account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="offset-md-1 col-md-6 d-none d-md-block">
            <img class="img-fluid" src="@asset('img/register.png')" alt="">
        </div>
    </div>
@endsection

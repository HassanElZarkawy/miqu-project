@extends('layouts.auth')

@section('title', __('Forgot Password'))

@section('content')
    <div class="row align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    @if ( true )
                        <h2 class="m-t-20">Horraaay!</h2>
                        <p class="m-b-30">An email has been sent to your inbox. Please follow the instructions sent to you to change your password</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route( 'home' ) }}" class="btn btn-primary">Close this window</a>
                        </div>
                    @else
                        <h2 class="m-t-20">Reset Your Password</h2>
                        <p class="m-b-30">Enter your Email to verify yourself</p>
                        <form method="post" action="{{ route('auth.forgot-password') }}">
                            {{ csrf() }}
                            <div class="form-group">
                                <label class="font-weight-semibold" for="email">Email: </label>
                                <div class="input-affix w-100">
                                    <i class="prefix-icon anticon anticon-user"></i>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="E-Mail" value="{{ old('email') }}">
                                </div>
                                @if( isset($error) )
                                    <p class="text-danger mt-2">{{ $error }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-between">
                                    <button class="btn btn-primary">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="offset-md-1 col-md-6 d-none d-md-block">
            <img class="img-fluid" src="@asset('img/forgot-password.png')" alt="I forgot my password">
        </div>
    </div>
@endsection
@extends('layouts.app')
@section('title', 'Login - Aqmfy')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4" style="margin-top: 60px; margin-bottom:60px;">
                <h1 class=" text-center login-title">{{ __('Sign in to continue to Aqmfy Stock') }}</h1>
                <div class="account-wall">
                    <img class="profile-img"
                        src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                        alt="">
                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="@error('email') has-error @enderror">
                            <input type="email" class="form-control " placeholder="Email address" required autofocus
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <span id="helpBlock2" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="@error('password') has-error @enderror" style="margin-bottom: 10px">
                            <input type="password" class="form-control" placeholder="Password" required name="password">
                            @error('password')
                                <span id="helpBlock2" class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            {{ __('Sign in') }}</button>
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="remember-me" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            {{ __('Remember me') }}
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="pull-right need-help">{{ __('Forgot Your Password?') }} </a><span
                                class="clearfix"></span>
                        @endif
                        {{-- <a class="btn btn-lg  btn-block btn-google" href="{{ url('auth/google') }}">
                            <i class="fa fa-google"></i>{{ __('SIGN IN WITH GOOGLE') }}</a>
                        <a class="btn btn-lg  btn-block btn-twitter" href="{{ url('auth/twitter') }}">
                            <i class="fa fa-twitter"></i>{{ __('SIGN IN WITH TWITTER') }}</a> --}}
                    </form>
                </div>
                <a href="{{ route('register') }}" class="text-center new-account">{{ __('Create an account') }} </a>
            </div>
        </div>
    </div>
@endsection

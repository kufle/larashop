@extends('layouts.app')

@section('content')

    <div class="card card-primary">
        <div class="card-header"><h4>Login</h4></div>

        <div class="card-body">
        <form method="POST" action="{{route('login')}}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" name="email" tabindex="1" required autofocus>
            @if($errors->has('email'))
            <div class="invalid-feedback">
                {{$errors->first('email')}}
            </div>
            @endif
            </div>

            <div class="form-group">
            <div class="d-block">
                <label for="password" class="control-label">Password</label>
                <div class="float-right">
                <a href="{{ route('password.request') }}" class="text-small">
                    Forgot Password?
                </a>
                </div>
            </div>
            <input id="password" type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" tabindex="2" required>
            @if($errors->has('password'))
            <div class="invalid-feedback">
                {{$errors->first('password')}}
            </div>
            @endif
            </div>

            <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' :''}} class="custom-control-input" tabindex="3" id="remember-me">
                <label class="custom-control-label" for="remember-me">Remember Me</label>
            </div>
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Login
            </button>
            </div>
        </form>
        <div class="text-center mt-4 mb-3">
            <div class="text-job text-muted">Login With Social</div>
        </div>
        <div class="row sm-gutters">
            <div class="col-6">
            <a class="btn btn-block btn-social btn-facebook">
                <span class="fab fa-facebook"></span> Facebook
            </a>
            </div>
            <div class="col-6">
            <a class="btn btn-block btn-social btn-twitter">
                <span class="fab fa-twitter"></span> Twitter
            </a>                                
            </div>
        </div>

        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Don't have an account? <a href="auth-register.html">Create One</a>
    </div>
    <div class="simple-footer">
        Copyright &copy; Stisla 2018
    </div>

@endsection

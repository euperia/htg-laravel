@extends('layouts.main')

@section('page_header')
    <h1>Login</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p>If you don't have an account you can
                <a href="{{ URL::route('auth_register') }}" title="Register">register here</a>
                <br>
                  Alternatively, you can skip the registration step by using a social account to login.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3>Sign in the quick way</h3>
            @include('auth/social-logins')
        </div>
        <div class="col-md-8">

            <h3>or sign-in via email</h3>

                <div class="well">
                    <form method="POST" action="/auth/login">
                        {!! csrf_field() !!}

                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="form-group">
                            <label for="login-email">Email address</label>
                            <input name="email" type="email" class="form-control" id="login-email"
                                  value="{{ old('email') }}" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="login-password">Password
                                <small><a href="{{ URL::route('password_email') }}" title="Forgot your password?">Forgot your password?</a></small>
                            </label>
                            <input name="password" type="password" class="form-control" id="login-password" placeholder="Password">
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" id="login-remember"> Remember me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-default">Submit</button>

                    </form>


                </div>
        </div>



    </div>

@endsection

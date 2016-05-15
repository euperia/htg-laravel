@extends('layouts.main')

@section('page_header')
Sign-In
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p>If you don't have an account you can
                <a href="{{ URL::route('auth_register') }}" title="Register">register here</a>
                <br>
                  Alternatively, you can skip the registration step by using a
                social account to login.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3>Sign in the quick way &hellip;</h3>
            @include('auth/social-logins')
        </div>
        <div class="col-md-8">

            <h3>or sign-in via email</h3>

                <div class="well">
                        {!! Form::open(array('route' => 'auth_login')) !!}

                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="form-group">
                            {!! Form::label('email', 'Email Address') !!}
                            {!! Form::email('email', old('email'), [
                                'class' => 'form-control',
                                'placeholder' => 'Email address'
                                ]) !!}
                        </div>

                        <div class="form-group">
                            <label for="login-password">Password
                                <small><a href="{{ URL::route('password_email') }}" title="Forgot your password?">forgot your password?</a></small>
                            </label>
                            {!! Form::password('password', [
                                'class' => 'form-control',
                                'id' => 'login-password',
                                'placeholder' => 'Password'
                                ]) !!}
                        </div>

                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('remember', 1, false, [
                                    'id' => 'login-remember'
                                ]) !!}
                                Remember me
                            </label>
                        </div>

                        {!! Form::button('Sign-in', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger'
                        ]) !!}


                    {!! Form::close() !!}


                </div>
        </div>
    </div>

@endsection

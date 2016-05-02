@extends('layouts.main')

@section('page_header')
Register
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p>If you have already registered via email you can
                <a href="{{ URL::route('auth_login') }}" title="Sign-in">sign-in here</a>
                <br>
                Alternatively, you can skip the registration step by using a social account to login.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <h3>Register the quick way&hellip;</h3>
            @include('auth/social-logins')
        </div>
        <div class="col-md-8">

            <h3>or register via email</h3>

            <div class="well">

                    {!! Form::open(array('route' => 'auth_register')) !!}

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name'), [
                            'class' => 'form-control',
                            'placeholder' => 'Your name'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email Address') !!}
                        {!! Form::email('email', old('email'), [
                        'class' => 'form-control',
                        'placeholder' => 'Email address'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', [
                                'class' => 'form-control',
                                'id' => 'login-password',
                                'placeholder' => 'Password'
                                ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Password again') !!}
                        {!! Form::password('password_confirmation', [
                                'class' => 'form-control',
                                'placeholder' => 'Please repeat your password'
                                ]) !!}
                    </div>

                    {!! Form::button('Register', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger'
                    ]) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
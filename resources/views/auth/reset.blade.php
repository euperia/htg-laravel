@extends('layouts.main')

@section('page_header')
    Reset your password
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="well">

                {!! Form::open(array('route' => 'password_reset')) !!}
                {!! Form::hidden('token',  $token ) !!}
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

                {!! Form::button('Reset Password', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger'
                    ]) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
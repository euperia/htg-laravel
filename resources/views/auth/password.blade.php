@extends('layouts.main')

@section('page_header')
    Password Reminder
@endsection

@section('content')
    <div class="row">
        <p>If you've forgotten your password (don't worry, we all do it!)
            you can reset it using the form below.</p>

        <p>Once you've submitted the form you'll get a reset link sent to your
            email address.</p>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="well">

                {!! Form::open(array('route' => 'password_email')) !!}

                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="form-group">
                    {!! Form::label('email', 'Email address') !!}
                    {!! Form::email('email', old('email'), [
                        'class' => 'form-control',
                        'placeholder' => 'Email address'
                    ]) !!}
                </div>
                {!! Form::button('Send Password Reset Link', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger'
                                        ]) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
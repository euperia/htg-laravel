@extends('layouts.master')

@section('content')

    <form method="POST" action="/password/email">
        {!! csrf_field() !!}
        
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    
        <div>
            Email
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
    
        <div>
            <button type="submit">
                Send Password Reset Link
            </button>
        </div>
    </form>
    
    <h2>Your options are:</h2>
    <ul>
        <li><a href="{{ URL::route('auth_login') }}" title="Log In">Log in</a> to your HTG Dashboard.</li>
        <li><a href="{{ URL::route('auth_register') }}" title="Register">Register</a> with us first</li>
    </ul>
    
@endsection
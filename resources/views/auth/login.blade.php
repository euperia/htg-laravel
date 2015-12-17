@extends('layouts.master')

@section('content')
<h1>Login</h1>
<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>

<p>Forgotten your password?</p>
<p>Click here to <a href="{{ URL::route('password_email') }}" title="Reset Password">Reset your password.</a></p>
@endsection
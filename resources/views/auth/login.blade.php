@extends('layouts.main')

@section('page_header')
    <h1>Login</h1>
@endsection

@section('content')

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
        <label for="login-password">Password</label>
        <input name="password" type="password" class="form-control" id="login-password" placeholder="Password">
    </div>

    <div class="checkbox">
        <label>
            <input type="checkbox" name="remember" id="login-remember"> Remember me
        </label>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

    <div class="form-group">
        <p>Forgotten your password?</p>
        <p>Click here to <a href="{{ URL::route('password_email') }}" title="Reset Password">Reset your password.</a></p>
    </div>

</form>
@endsection
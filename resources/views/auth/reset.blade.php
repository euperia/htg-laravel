@extends('layouts.main')

@section('page_header')
    <h1>Reset your password</h1>
@endsection

@section('content')
    
    <form method="POST" action="/password/reset">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">
    
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="form-group">
            <label for="login-email">Email address</label>
            <input name="email" type="email" class="form-control"
                   id="login-email" value="{{ old('email') }}"
                   placeholder="Email">
        </div>

        <div class="form-group">
            <label for="login-password">Password</label>
            <input name="password" type="password" class="form-control"
                   id="login-password" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="login-confirm-password">Confirm Password</label>
            <input name="password_confirmation" type="password"
                   class="form-control" id="login-confirm-password"
                   placeholder="Confirm Password">
        </div>

        <button type="submit" class="btn btn-default">Reset Password</button>
    </form>
@endsection
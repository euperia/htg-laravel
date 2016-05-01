@extends('layouts.main')

@section('page_header')
    <h1>Password Reminder</h1>
@endsection

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

        <div class="form-group">
            <label for="login-email">Email address</label>
            <input name="email" type="email" class="form-control" id="login-email"
                   value="{{ old('email') }}" placeholder="Email">
        </div>

        <button type="submit" class="btn btn-default">Send Password Reset Link</button>

    </form>

@endsection
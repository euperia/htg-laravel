@extends('layouts.main')

@section('page_header')
    <h1>Register</h1>
@endsection

@section('content')
   

        <form role="form" method="post" action="/auth/register">
            {!! csrf_field() !!}

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group">
                <label for="login-name">Name</label>
                <input name="name" type="text" class="form-control"
                       id="login-name" value="{{ old('name') }}"
                       placeholder="Your name">
            </div>

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


            <button type="submit" class="btn btn-default">Submit</button>


        </form>

@endsection
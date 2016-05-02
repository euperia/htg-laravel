@extends('layouts.main')

@section('title')
HTG: Home
@endsection

@section('content')

    <div class="jumbotron">
        <h1>Hit The Ground: Laravel Edition</h1>
        <p><em>Hit The Ground (HTG)</em> is a starter app for web development projects
            aimed at rapid prototyping.</p>
        <p>This is the Laravel implementation of HTG.</p>
    </div>

    @if (Auth::guest())
    <h2>Your options are:</h2>
    <ul>
        <li><a href="{{ URL::route('auth_login') }}" title="Log In">Log in</a> to your HTG Dashboard.</li>
        <li><a href="{{ URL::route('auth_register') }}" title="Register">Register</a> with us first</li>
    </ul>
    @else
    <h3>Welcome back {{ Auth::user()->name }}</h3>

    @endif
@endsection
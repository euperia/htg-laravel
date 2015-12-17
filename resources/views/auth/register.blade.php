@extends('layouts.master')

@section('content')
   
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Please sign up <small>It's free!</small></h3>
      </div>
      <div class="panel-body">
        <form role="form" method="post" action="/auth/register">
            {!! csrf_field() !!}
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <input type="text" name="name" class="form-control input-sm" value="{{ old('name') }}" placeholder="Name">
            </div>
            </div>


          <div class="form-group">
            <input type="email" name="email" class="form-control input-sm" value="{{ old('email') }}" placeholder="Email Address">
          </div>

          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <input type="password" name="password" class="form-control input-sm" placeholder="Password">
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
              </div>
            </div>
          </div>

          <input type="submit" value="Register" class="btn btn-info btn-block">

        </form>
      </div>
    </div>
  </div>
@endsection
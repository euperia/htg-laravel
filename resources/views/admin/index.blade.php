@extends('layouts.admin')

@section('title')
    Home
@endsection

@section('page_header')
    Admin Dashboard
@endsection

@section('content')

<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count($users) }}</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{ URL::route('admin::users') }}" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
</div>

@endsection

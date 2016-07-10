@extends('layouts.admin')

@section('title')
Edit user
@endsection

@section('page_header')
Edit User
@endsection


@section('content')
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Edit {{ $user->name }}</h3>
            </div>
            <div class="box-body">

                <div class="col-md-8 col-md-offset-2">
                    {!! Form::model($user, array('route' => array('admin::user::update', $user->id))) !!}
                    {!! Form::hidden('id') !!} 
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group">
                        <img src="{{ $user->avatar }}" class="img-circle" />

                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name'), [
                            'class' => 'form-control',
                            'placeholder' => 'Your name',
                            'value' => $user->name
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email Address') !!}
                        {!! Form::email('email', old('email'), [
                        'class' => 'form-control',
                        'placeholder' => 'Email address',
                        'value' => $user->email
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', [
                                'class' => 'form-control',
                                'id' => 'login-password',
                                'placeholder' => 'Password'
                                ]) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('role_id', 'Role') !!}
                        {!! Form::select('role_id', $roles, null, [
                            'class' => 'form-control'
                        ]) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', 
                                [
                                    '0' => 'Disabled',
                                    '1' => 'Active'
                                ], null, ['class' => 'form-control'])  !!}
                    </div>


                    {!! Form::button('Update', [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ]) !!}
                    {!! Form::close() !!}
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>

@endsection



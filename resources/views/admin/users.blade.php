@extends('layouts.admin')

@section('title')
    User management
@endsection

@section('page_header')
    User Management
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $userCount }}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Users</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered Date</th>
                        <th style="width: 40px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}.</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->hasRole('Root'))
                                    <small class="badge bg-red">Root</small>
                                @endif
                                @if ($user->hasRole('Administrator'))
                                    <small class="badge bg-orange">
                                        Administrator
                                    </small>
                                @endif
                                @if ($user->hasRole('Guest'))
                                    <small class="badge bg-aqua">Guest</small>
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="/admin/user/{{ $user->id }}"
                                   title="Edit {{ $user->name }}"><i
                                            class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
                {{ $users->links() }}
                
            </div>
        </div>
    </div>
@endsection

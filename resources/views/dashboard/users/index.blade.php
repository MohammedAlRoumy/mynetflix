@extends('layouts.dashboard.app')

@section('content')
    <div>
        <h2>Users</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Users</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <div class="row">
                    <div class="col-12">
                        <form action="">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="search" name="search" autofocus class="form-control"
                                               placeholder="search" value="{{request()->search}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <select name="role_id" class="form-control">
                                        <option value="">All roles</option>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{$role->id}}" {{request()->role_id == $role->id ?'selected':''}}>
                                                {{$role->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Search
                                    </button>
                                    @if(auth()->user()->hasPermission('create_users'))
                                        <a href="{{route('dashboard.users.create')}}" class="btn btn-success"><i
                                                class="fa fa-plus"></i> Add</a>
                                    @else
                                        <a href="#" class="btn btn-success" disabled=""><i
                                                class="fa fa-plus"></i> Add</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        @if($users->count()>0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $index=>$user)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                <h5 style="display: inline-block"><span
                                                        class="badge badge-primary">{{$role->name}}</span></h5>
                                            @endforeach
                                            {{--                                            {{implode(', ', $user->roles->pluck('name')->toArray())}}--}}
                                        </td>

                                        <td>
                                            <input type="checkbox" data-toggle="toggle"
                                                   data-id="{{$user->id}}" name="status"
                                                   class="js-switch user-switch" {{ $user->status == 1 ? 'checked' : '' }}>
                                        </td>

                                        <td>
                                            @if(auth()->user()->hasPermission('update_users'))

                                                <a href="{{route('dashboard.users.edit',$user->id)}}"
                                                   class="btn btn-warning btn-sm"><i
                                                        class="fa fa-edit"></i> Edit</a>
                                            @else
                                                <a href="#"
                                                   class="btn btn-warning btn-sm" disabled=""><i
                                                        class="fa fa-edit"></i> Edit</a>
                                            @endif

                                            @if(auth()->user()->hasPermission('delete_users'))
                                                <form action="{{route('dashboard.users.destroy',$user->id)}}"
                                                      method="post"
                                                      style="display: inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                            class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            @else
                                                <a href="#" class="btn btn-danger btn-sm " disabled=""><i
                                                        class="fa fa-trash"></i> Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3>Sorry no records found</h3>
                        @endif
                    </div>
                </div>
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

@endsection

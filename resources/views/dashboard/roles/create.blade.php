@extends('layouts.dashboard.app')

@section('content')

    <div>
        <h2>Roles</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{route('dashboard.roles.index')}}">Roles</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="col-md-12">

                    {{--            <h3 class="tile-title">Add role</h3>--}}
                    <div class="tile-body">
                        <form class="form-horizontal" method="post" action="{{route('dashboard.roles.store')}}">
                            @csrf
                            @method('post')
                            @include('dashboard.partials._errors')

                            <div class="form-group row">
                                <label class="control-label col-md-3">role name</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="name" type="text" placeholder="Enter role name"
                                           value="{{old('name')}}">
                                </div>
                            </div>

                            {{--permissions--}}
                            <div class="form-group">
                                <h4>Permissions</h4>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 20%;">Model</th>
                                        <th>Permissions</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @php
                                        $models = ['categories', 'movies', 'users','settings'];
                                    @endphp

                                    @foreach ($models as $index=>$model)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td class="text-capitalize">{{ $model }}</td>
                                            <td>
                                                @php
                                                    $permission_maps = ['create', 'read', 'update', 'delete'];
                                                @endphp

                                                @if ($model == 'settings')
                                                    @php
                                                        $permission_maps = ['create', 'read'];
                                                    @endphp
                                                @endif

                                                <select name="permissions[]" class="form-control select2" multiple>
                                                    @foreach ($permission_maps as $permission_map)
                                                        <option value="{{ $permission_map . '_' . $model }}">{{ $permission_map }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Add
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-secondary" href="{{route('dashboard.roles.index')}}"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

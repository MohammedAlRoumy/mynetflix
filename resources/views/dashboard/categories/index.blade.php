@extends('layouts.dashboard.app')

@section('content')

    <div>
        <h2>Categories</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Categories</li>
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
                                    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Search
                                    </button>
                                    @if(auth()->user()->hasPermission('create_categories'))
                                        <a href="{{route('dashboard.categories.create')}}" class="btn btn-success"><i
                                                class="fa fa-plus"></i> Add</a>
                                    @else
                                        <a href="#" disabled="" class="btn btn-success"><i
                                                class="fa fa-plus"></i> Add</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        @if($categories->count()>0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>movies count</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $index=>$category)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->movies_count}}</td>
                                        <td>
                                            <input type="checkbox" data-toggle="toggle"
                                                   data-id="{{$category->id}}" name="status"
                                                   class="js-switch categories-switch" {{ $category->status == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_categories'))
                                                <a href="{{route('dashboard.categories.edit',$category->id)}}"
                                                   class="btn btn-warning btn-sm"><i
                                                        class="fa fa-edit"></i> Edit</a>
                                            @else
                                                <a href="#" disabled=""
                                                   class="btn btn-warning btn-sm"><i
                                                        class="fa fa-edit"></i> Edit</a>
                                            @endif

                                            @if(auth()->user()->hasPermission('delete_categories'))
                                                <form action="{{route('dashboard.categories.destroy',$category->id)}}"
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
                {{ $categories->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

@endsection

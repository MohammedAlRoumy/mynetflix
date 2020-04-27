@extends('layouts.dashboard.app')

@section('content')

<div>
    <h2>Categories</h2>
</div>

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ul>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="col-md-12">
                <div class="tile-body">
                    <form class="form-horizontal" method="post" action="{{route('dashboard.categories.store')}}">
                        @csrf
                        @method('post')
                        @include('dashboard.partials._errors')
                        <div class="form-group row">
                            <label class="control-label col-md-3">Category name</label>
                            <div class="col-md-9">
                                <input class="form-control" name="name" type="text" placeholder="Enter category name" value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="1">ON
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="0">OFF
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{route('dashboard.categories.index')}}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                    </form>
                </div>
                {{--<div class="tile-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{route('dashboard.categories.index')}}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
@endsection

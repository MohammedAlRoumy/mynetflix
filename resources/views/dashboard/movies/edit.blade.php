@extends('layouts.dashboard.app')

@section('content')
    <div>
        <h2>movies</h2>
    </div>


    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{route('dashboard.movies.index')}}">movies</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="col-md-12">

                    {{--            <h3 class="tile-title">Add movie</h3>--}}
                    <div class="tile-body">
                        {{--                <form class="form-horizontal" method="post" action="{{route('dashboard.movies.update',$movies->id)}}">--}}
                        <form id="movie__properties"
                              class="form-horizontal"
                              method="post"
                              enctype="multipart/form-data"
                              action="{{ route('dashboard.movies.update', ['movie' => $movie->id, 'type' => 'update']) }}"
                              enctype="multipart/form-data"
                        >
                            @csrf
                            @method('put')
                            @include('dashboard.partials._errors')

                            <div class="form-group row">
                                <label class="control-label col-md-3">movie name</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="movie__name" name="name" type="text"
                                           value="{{old('name',$movie->name)}}"      placeholder="Enter movie name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">movie description</label>
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control"
                                              placeholder="enter movie description">{{old('description',$movie->description)}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">movie poster</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="poster" type="file">
                                    <img src="{{$movie->poster_path}}" style="width: 255px;height: 378px; margin-top:10px;" alt="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">movie image</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="image" type="file">
                                    <img src="{{$movie->image_path}}" style="width: 255px;height: 255px; margin-top:10px;" alt="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">movie categories</label>
                                <div class="col-md-9">
                                    <select name="categories[]" class="form-control select2" multiple style="width: 100%">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{in_array($category->id, $movie->categories->pluck('id')->toArray())?'selected':''}}
                                            >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">movie year</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="year" type="text" value="{{old('year',$movie->year)}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">movie rating</label>
                                <div class="col-md-9">
                                    <input class="form-control" min="1" name="rating" type="text" value="{{old('rating',$movie->rating)}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-edit"></i>Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

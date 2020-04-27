@extends('layouts.dashboard.app')

@push('styles')
    <style>
        #movie__upload-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25vh;
            flex-direction: column;
            border: 1px solid black;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')

    <div>
        <h2>movies</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{route('dashboard.movies.index')}}">movies</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="col-md-12">

                    <div id="movie__upload-wrapper"
                         onclick="document.getElementById('movie__file-input').click()"
                         style="display: {{ $errors->any() ? 'none' : 'flex' }};"
                    >
                        <i class="fa fa-video-camera fa-2x"></i>
                        <p>Click to upload</p>
                    </div>

                    <input type="file"
                           name=""
                           data-movie-id="{{ $movie->id }}"
                           data-url="{{ route('dashboard.movies.store') }}"
                           id="movie__file-input"
                           style="display: {{$errors->any() ? 'block':'none'}}">

                    <div class="tile-body">
                        <form id="movie__properties"
                              class="form-horizontal"
                              method="post"
                              enctype="multipart/form-data"
                              action="{{ route('dashboard.movies.update',['movie' => $movie->id, 'type' => 'publish']) }}"
                              enctype="multipart/form-data"
                              style="display: {{ $errors->any() ? 'block' : 'none' }};"
                        >
                            @csrf
                            @method('put')
                            @include('dashboard.partials._errors')

                            <div class="form-group row" style="display: {{$errors->any() ? 'none':'block'}}">
                                <label class="control-label col-md-3" id="movie__upload-status">movie uploading</label>

                                <div class="col-md-9">
                                    <div class="progress">
                                        <div class="progress-bar" id="movie__upload-progress" role="progressbar"></div>
                                    </div>
                                </div>
                            </div>

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
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">movie image</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="image" type="file">
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
                                <button class="btn btn-primary" id="movie__submit-btn" type="submit"
                                        style="display: {{$errors->any() ? 'block':'none'}}"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Publish
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                {{-- <a class="btn btn-secondary" href="{{route('dashboard.movies.index')}}"><i
                                         class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.dashboard.app')

@section('content')

    <div>
        <h2>settings</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Social links</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="col-md-12">

                    {{--            <h3 class="tile-title">Add setting</h3>--}}
                    <div class="tile-body">
                        <form class="form-horizontal" method="post" action="{{route('dashboard.settings.store')}}">
                            @csrf
                            @method('post')
                            @include('dashboard.partials._errors')

                            @php
                                $social_links = ['facebook','google','twitter','youtube'];
                            @endphp

                            @foreach($social_links as $social_link)

                                <div class="form-group row">
                                    <label class="control-label col-md-3">{{$social_link}} link</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="{{$social_link}}_link" type="text"
                                               value="{{setting($social_link.'_link')}}">
                                    </div>
                                </div>

                            @endforeach

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Add
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a class="btn btn-secondary" href="{{route('dashboard.welcome')}}"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

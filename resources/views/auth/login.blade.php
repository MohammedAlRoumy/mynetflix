@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="login__bg"></div>

        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto col-md-6 bg-white mx-auto p-3">
                    <h2 class="text-center">Netflix<span class="text-primary">ify</span></h2>
                    <hr>
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        @method('post')

                        @include('dashboard.partials._errors')

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <div class="form-group">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" class="custom-control-input" id="customCheckbox1">
                                <label for="customCheckbox1" class="custom-control-label">Remmber Me</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Login</button>
                        </div>

                        <p class="text-center">Create new account <a href="{{route('register')}}">Register</a></p>

                        <hr>
                        <a href="/login/facebook" class="btn btn-primary btn-block" style="background: #3b5998">
                            <i class="fab fa-facebook-f"></i> Login by facebook
                        </a>
                        <a href="/login/google" class="btn btn-primary btn-block" style="background: #ea4335">
                            <span class="fab fa-google"></span> Login by google
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="login__bg"></div>

        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto col-md-6 bg-white mx-auto p-3">
                    <h2 class="text-center">Netflix<span class="text-primary">ify</span></h2>
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        @method('post')

                        @include('dashboard.partials._errors')

                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" name="name" class="form-control" id="username">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                   {{--     <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="confirm-password" class="form-control" id="confirm-password">
                        </div>--}}


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>

                        <p class="text-center">Already have an account <a href="{{route('login')}}">Login</a></p>

                        <a href="/login/facebook" class="btn btn-primary btn-block" style="background: #3b5998"><span
                                class="fab fa-facebook-f"></span> Login by facebook
                        </a>
                        <a href="/login/google" class="btn btn-primary btn-block" style="background: #ea4335"><span
                                class="fab fa-google"></span> Login by google
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

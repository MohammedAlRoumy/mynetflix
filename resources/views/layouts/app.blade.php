<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Netflixify</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--    fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,500,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
          integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

{{--    <link rel="stylesheet" href="{{asset('css/font-awesome5.11.2.min.css')}}">--}}

<!--    bootstrap-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!--    vendor-->
    <link rel="stylesheet" href="{{asset('css/vendor.min.css')}}">

    <!--    main style-->
    <link rel="stylesheet" href="{{asset('css/main.min.css')}}">

{{--    auto complete--}}
    <link rel="stylesheet" href="{{asset('plugins/easyautocomplete/easy-autocomplete.min.css')}}">
    <style>
        .fw-900{
            font-weight: 900;
        }
        .easy-autocomplete{
            width: 80%;
        }
        .easy-autocomplete input{
            color: white !important;
        }
        .eac-icon-left .eac-item img{
            max-height: 60px !important;
        }
    </style>
</head>
<body>

@yield('content')


<!--jquery-->
<script src="{{asset('js/jquery-3.4.0.min.js')}}"></script>

<!--    bootstrap-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>

<!--vendor-->
<script src="{{asset('js/vendor.min.js')}}"></script>
<!--    main js-->
<script src="{{asset('js/main.min.js')}}"></script>

<!--    player js-->
<script src="{{asset('js/playerjs.js')}}"></script>

<!--    auto complete js-->
<script src="{{asset('plugins/easyautocomplete/jquery.easy-autocomplete.min.js')}}"></script>

<script src="{{asset('js/custom/movie.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var options = {
        url: function(search) {
            return "/movies?search=" + search;
        },

        getValue: "name",

        template:{
            type:'iconLeft',
            fields:{
                iconSrc: "poster_path"
            }
        },
        list: {
            onChooseEvent: function() {
                var movie = $('.form-control[type="search"]').getSelectedItemData();
                var url = window.location.origin + '/movies/' + movie.id;
                window.location.replace(url);
            }
        }
    };

    $('.form-control[type="search"]').easyAutocomplete(options)

    $(document).ready(function () {
        $("#banner .movies").owlCarousel(
            {
                loop: true,
                nav: false,
                dots: false,
                items: 1,
            }
        );

        $(".listing .movies").owlCarousel(
            {
                stagePadding: 50,
                loop: true,
                nav: false,
                dots: false,
                margin: 15,
                responsive: {
                    0: {
                        items: 1,
                    },
                    480: {
                        items: 2,
                    },
                    600: {
                        items: 3,

                    },
                    900: {
                        items: 4,

                    },
                }
            }
        );
    });
</script>

@stack('scripts')

</body>
</html>

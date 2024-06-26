<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>@yield('title') | Rumah Sakit Mas Amsyar</title>
        
        <link href="{{asset('asset/css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('asset/css/responsive.css')}}" rel="stylesheet">
        <link href="{{asset('asset/css/color-themes/tealblue.css')}}" rel="stylesheet" id="theme-color-file" >
        <link href="{{asset('asset/images/favicon.png')}}" rel="shortcut icon" type="image/x-icon">
        <link href="{{asset('asset/images/favicon.png')}}" rel="icon" type="image/x-icon">
        <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
        <!--[if lt IE 9]><script src="{{asset('asset/js/respond.js')}}"></script><![endif]-->
        @yield('addition_css')
    </head>

    <body>
        <div class="page-wrapper">
            <div class="preloader"></div>
            @include('components.medicoz.nav')
            @yield('content')
            @include('components.medicoz.footer')
        </div>
        <script>
            const assetUrl = "{{asset('/')}}";
        </script>
        <script src="{{asset('asset/js/jquery.js')}}"></script>  
        <script src="{{asset('asset/js/popper.min.js')}}"></script>
        <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('asset/js/jquery.fancybox.js')}}"></script>
        <script src="{{asset('asset/js/jquery.modal.min.js')}}"></script>
        <script src="{{asset('asset/js/mmenu.polyfills.js')}}"></script>
        <script src="{{asset('asset/js/mmenu.js')}}"></script>
        <script src="{{asset('asset/js/appear.js')}}"></script>
        <script src="{{asset('asset/js/mixitup.js')}}"></script>
        <script src="{{asset('asset/js/owl.js')}}"></script>
        <script src="{{asset('asset/js/wow.js')}}"></script>
        <script src="{{asset('asset/js/script.js')}}"></script>
        @yield('addition_script')
    </body>
</html>



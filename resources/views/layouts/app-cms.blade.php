<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.default.head')
        <link href="{{asset('asset/css/style-custom.css')}}" rel="stylesheet">
        @yield('addition_css')
    </head>

    <body>
        <div class="page-wrapper">
            <div class="preloader"></div>
            @include('components.default.nav-cms')
            <div id="main">
                @yield('content')
            </div>
            @include('components.default.footer-cms')
        </div>
        @include('components.default.script')
        <script>    
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        @yield('addition_script')
    </body>
</html>



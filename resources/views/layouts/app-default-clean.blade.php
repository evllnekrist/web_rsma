<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.default.head')
        @yield('addition_css')
    </head>

    <body>
        @include('components.default.nav-public')
        @yield('content')
        @include('components.default.script')
        @yield('addition_script')
    </body>
</html>



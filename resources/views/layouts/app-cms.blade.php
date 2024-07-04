<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="tapi" content="{{Session::get('_token_api')}}">
        @include('components.default.head')
        {{-- <link href="{{asset('asset/plugins/summernote/summernote-bs4.min.css')}}" rel="stylesheet"> --}}
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
        {{-- <script src="{{asset('asset/plugins/summernote/summernote-bs4.min.js')}}"></script> --}}
        <script src="{{ asset('asset/plugins/ckeditor/ckeditor.js') }}"></script>
        @yield('addition_script')
    </body>
</html>



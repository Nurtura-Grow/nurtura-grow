@extends('layout.base')

@section('body')

    <body class="login">
        @yield('content')

        <!-- BEGIN: JS Assets-->
        @yield('script')
        @vite(['resources/js/app.js'])
        <!-- END: JS Assets-->

    </body>
@endsection

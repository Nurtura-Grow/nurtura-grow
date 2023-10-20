@extends('layout.base')

@section('body')
    <body class="app">
        @include('layout.components.side-menu')

        @yield('content')

        <!-- BEGIN: JS Assets-->

        <!-- END: JS Assets-->
    </body>
@endsection

@extends('layout.base')

@section('body')
    <body class="app">
        @include('sweetalert::alert')
        @yield('content')

        @include('layout.partials.scripts')
    </body>
@endsection

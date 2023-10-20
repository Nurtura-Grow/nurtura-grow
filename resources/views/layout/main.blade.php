@extends('layout.base')

@section('body')
    <body class="app">
        @include('layout.components.side-menu')

        @yield('content')

        @include('layout.partials.scripts')
    </body>
@endsection

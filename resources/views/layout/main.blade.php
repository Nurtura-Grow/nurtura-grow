@extends('layout.base')

@section('body')
    <body class="app">
        @yield('content')

        @include('layout.partials.scripts')
    </body>
@endsection

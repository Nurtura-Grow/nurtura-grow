<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ $title ?? 'NurturaGrow' }} </title>

    <!-- BEGIN: CSS Assets-->
    @include('partials.styles')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

@yield('body')

</html>

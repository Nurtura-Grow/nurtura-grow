<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.svg') }}">

    <title> {{ $title ?? 'NurturaGrow' }} </title>

    <!-- BEGIN: CSS Assets-->
    @include('layout.partials.styles')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

@yield('body')

</html>

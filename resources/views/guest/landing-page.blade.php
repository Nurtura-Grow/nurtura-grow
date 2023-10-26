@extends('layout.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
@endpush

@section('body')

    <body class="p-0 m-0 relative">
        @include('guest.navbar')

        {{-- Section 1 --}}
        <section class="min-h-[90vh] p-0 m-0 bg-rgb-light-green relative">
            {{-- Background Ornament --}}
            <img class="hidden lg:block absolute bottom-0 left-0 w-full"
                src="{{ asset('images/landing-page/section1.svg') }}">
            <img class="block lg:hidden absolute bottom-0 left-0 w-full"
                src="{{ asset('images/landing-page/section1-mobile.svg') }}">

        </section>
        {{-- Section 2 - Fitur --}}
        <section class="min-h-screen p-0 m-0 bg-white" id="fitur">
            Fitur
        </section>
        {{-- Section 3 - Tentang Kami --}}
        <section class="min-h-screen p-0 m-0 bg-white" id="tentang-kami">
            Tentang Kami
        </section>
        {{-- Section 4 - CTA --}}
        <section class="min-h-screen p-0 m-0 bg-rgb-light-green" id="aksi">
            CTA
        </section>

        @include('layout.partials.scripts')
    </body>
@endsection

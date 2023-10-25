@extends('layout.base')

@push('styles')
    <style>
        * {
            scroll-behavior: smooth;
        }
    </style>
@endpush

@section('body')

    <body class="p-0 m-0 relative">
        {{-- Navbar --}}
        <nav class="sticky top-0 bg-rgb-light-green z-[1000]">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('index') }}" class="flex items-center">
                    <img src="{{ asset('images/logo-bg.svg') }}" class="w-8 mr-3" alt="NurturaGrow Logo" />
                    <span class="self-center text-2xl font-semibold  text-rgb-secondary whitespace-nowrap">NurturaGrow</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="font-medium text-secondary flex flex-col p-4 md:p-0 mt-4 border rounded-lg  md:flex-row md:space-x-8 md:mt-0 md:border-0 ">
                        <li>
                            <a href="#" class="block py-2 pl-3 pr-4 rounded md:bg-transparent"
                                aria-current="page">Beranda</a>
                        </li>
                        <li>
                            <a href="#fitur" class="block py-2 pl-3 pr-4 rounded">Fitur</a>
                        </li>
                        <li>
                            <a href="#tentang-kami" class="block py-2 pl-3 pr-4 rounded  ">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#aksi" class="block py-2 pl-3 pr-4 rounded  ">Panduan</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}"
                                class="btn btn-white border-rgb-secondary py-2 pl-3 pr-4 rounded">Masuk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Section 1 --}}
        <section class="min-h-screen p-0 m-0 bg-rgb-light-green relative">
            {{-- Background Ornament --}}
            <img class="hidden lg:block absolute bottom-0 left-0 w-full"
                src="{{ asset('images/landing-page/section1.svg') }}">
            <img class="block lg:hidden absolute bottom-0 left-0 w-full"
                src="{{ asset('images/landing-page/section1-mobile.svg') }}">

        </section>
        {{-- Section 2 - Fitur --}}
        <section class="min-h-screen p-0 m-0 bg-white" id="fitur"></section>
        {{-- Section 3 - Tentang Kami --}}
        <section class="min-h-screen p-0 m-0 bg-white" id="tentang-kami"></section>
        {{-- Section 4 - CTA --}}
        <section class="min-h-screen p-0 m-0 bg-rgb-light-green" id="aksi"></section>
    </body>
@endsection

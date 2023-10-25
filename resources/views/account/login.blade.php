@extends('layout.base')

@push('styles')
    <style>
        @media only screen and (min-width: 1280px) {
            body {
                background-image: url("{{ asset('images/background/login.svg') }}");
            }
        }
    </style>
@endpush

@section('body')

    <body class="flex min-h-screen p-0 m-0 bg-no-repeat bg-fixed bg-left bg-cover">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col h-screen">
                    <a href="{{ route('index') }}" class="-intro-x flex items-center pt-10">
                        <img alt="" class="w-8" src="{{ asset('images/logo-nobg.svg') }} ">
                        <span class="text-white text-lg ml-3">NurturaGrow</span>
                    </a>
                    <div class="my-auto">
                        <img alt="" class="-intro-x w-1/2 -mt-16" src="{{ asset('images/logo.svg') }}">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            NurturaGrow<br>
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70">
                            Solusi sederhana untuk pertanian luar biasa
                        </div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="my-auto mx-auto xl:ml-20 bg-white px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full xl:w-3/4">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Masuk
                        </h2>
                        <form method="POST" action="{{ route('auth.login') }}" class="intro-x mt-8">
                            @csrf
                            <input type="text" name="email" class="intro-x form-control w-full py-3  block"
                                placeholder="Email">
                            <input type="password" name="password" class="intro-x form-control py-3 px-4 block mt-4"
                                placeholder="Password">

                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                    <label class="cursor-pointer select-none" for="remember-me">Ingat saya</label>
                                </div>
                                <a href="">Lupa Password?</a>
                            </div>

                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
                                    type="submit">Masuk</button>


                                <a href="{{ route('register') }}"
                                    class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top"
                                    type="button">Daftar</a>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>

        @include('layout.partials.scripts')
    </body>
@endsection

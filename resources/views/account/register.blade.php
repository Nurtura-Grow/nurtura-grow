@extends('layout.base')

@push('styles')
    <style>
        @media only screen and (min-width: 1280px) {
            body {
                background-image: url("{{ asset('images/background/register.svg') }}");
            }
        }
    </style>
@endpush

@section('body')

    <body class="flex min-h-screen p-0 m-0 bg-no-repeat bg-fixed bg-left bg-cover">
        <div class="container sm:px-10">

            <div class="hidden xl:block absolute top-5 p-5">
                <a href="" class="-intro-x flex">
                    <img alt="" class="w-6" src="{{ asset('images/logo.svg') }} ">
                    <span class="text-rgb-secondary font-bold text-lg ml-3"> NurturaGrow </span>
                </a>
            </div>

            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Register Form -->

                <div class="h-screen xl:h-auto flex flex-col p-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="my-auto mx-auto xl:mx-0 bg-white px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full xl:w-3/4">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Daftar
                        </h2>
                        <form method="POST" action="{{ route('auth.login') }}" class="intro-x mt-8">
                            @csrf
                            <input type="text" name="email" class="intro-x form-control w-full py-3  block"
                                placeholder="Email">
                            <input type="password" name="password" class="intro-x form-control py-3 px-4 block mt-4"
                                placeholder="Password">
                            <input type="text" name="text" class="intro-x form-control py-3 px-4 block mt-4"
                                placeholder="text">
                            <input type="text" name="text" class="intro-x form-control py-3 px-4 block mt-4"
                                placeholder="text">

                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
                                    type="submit">Daftar</button>


                                <a href="{{ route('login') }}"
                                    class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top"
                                    type="button">Masuk</a>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- END: Register Form -->

                <!-- BEGIN: Register Info -->
                <div class="hidden xl:flex flex-col h-screen justify-items-end pt-10">
                    <div class="my-auto text-end ">
                        <img alt="" class="-intro-x ml-auto w-1/2 -mt-16" src="{{ asset('images/logo.svg') }}">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            NurturaGrow<br>
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70">
                            Solusi sederhana untuk pertanian luar biasa
                        </div>
                    </div>
                </div>
                <!-- END: Register Info -->
            </div>
        </div>

        @include('layout.partials.scripts')
    </body>
@endsection

@extends('layout.base')

@section('body')

    <body class="flex h-screen p-0 m-0 bg-no-repeat bg-rgb-light-green overflow-hidden">
        <div class="sm:px-8 lg:px-12 xl:px-20 h-screen">
            <div class="block lg:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden lg:flex flex-col h-screen">
                    <a href="{{ route('index') }}" class="-intro-x flex items-center pt-10">
                        <img alt="" class="w-10" src="{{ asset('images/logo.svg') }} ">
                        <span class="text-rgb-dark font-bold text-lg ml-3">NurturaGrow</span>
                    </a>
                    <div class="my-auto">
                        <img alt="" class="-intro-x w-fit"
                            src="{{ asset('images/illustration/auth/verifikasi-otp.png') }}">

                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen lg:h-auto flex py-5 px-5 lg:py-0 lg:my-0">
                    <div
                        class="intro-x my-auto relative flex flex-col mx-auto xl:ml-20 bg-white p-16 rounded-lg shadow-md lg:shadow-none w-full">
                        <div class="absolute left-0 top-0 mt-5 ml-6">
                            <a href="{{ route('login') }}" class="text-gray-500">
                                <i class="fa-solid fa-chevron-left mr-3"></i>Kembali ke halaman login
                            </a>
                        </div>

                        <h2 class="intro-x font-bold text-2xl lg:text-3xl text-center lg:text-left">
                            Verifikasi Kode OTP
                        </h2>
                        <p class="intro-x mt-3">
                            Masukkan kode OTP yang dikirimkan ke email Anda.
                        </p>

                        <form method="POST" action="{{ route('auth.verifikasi') }}" class="intro-x mt-8 w-full">
                            @csrf
                            <div class="flex flex-row gap-3 h-16" id="otp-container">
                                <input class="form-control border-2 text-xl font-bold border-gray-300 h-full text-center"
                                    type="text" maxlength="1" />
                                <input class="form-control border-2 text-xl font-bold border-gray-300 h-full text-center"
                                    type="text" maxlength="1" />
                                <input class="form-control border-2 text-xl font-bold border-gray-300 h-full text-center"
                                    type="text" maxlength="1" />
                                <input class="form-control border-2 text-xl font-bold border-gray-300 h-full text-center"
                                    type="text" maxlength="1" />
                            </div>

                            <div class="intro-x mt-5 lg:mt-8 text-center lg:text-left">
                                <a class="w-full btn bg-rgb-secondary text-white shadow-md" id="buttonTambah">
                                    Verifikasi OTP
                                </a>
                            </div>
                        </form>

                        <a class="mt-4 text-center intro-x underline underline-offset-2"
                            href="{{ route('password') }}">Masukkan email lain</a>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>

        @include('layout.partials.scripts')
        @vite(['resources/js/auth/verifikasi-otp.js'])
    </body>
@endsection

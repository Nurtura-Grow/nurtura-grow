@extends('layout.base')

@section('body')
    <body class="flex h-screen p-0 m-0 bg-no-repeat bg-rgb-light-green overflow-hidden">
        <div class="h-screen container sm:px-8 lg:px-12 xl:px-24">
            <div class="h-screen block lg:grid lg:grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden lg:flex flex-col h-screen">
                    <a href="{{ route('index') }}" class="-intro-x flex items-center pt-10">
                        <img alt="" class="w-10" src="{{ asset('images/logo.svg') }} ">
                        <span class="text-rgb-dark font-bold text-lg ml-3">NurturaGrow</span>
                    </a>
                    <div class="my-auto">
                        <img alt="" class="-intro-x w-3/4"
                            src="{{ asset('images/illustration/auth/forgot-password.png') }}">

                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen flex items-center justify-center py-5 px-5 lg:py-0 lg:my-0 overflow-hidden">
                    <div
                        class="intro-x my-auto flex flex-col mx-auto xl:ml-20 bg-white p-16 rounded-lg shadow-md lg:shadow-none w-full">
                        <h2 class="intro-x font-bold text-2xl lg:text-3xl text-center lg:text-left">
                            Lupa Password?
                        </h2>
                        <p class="intro-x mt-3">
                            Jangan khawatir! Masukkan alamat email yang ditautkan dengan akun Anda.
                        </p>

                        <form method="POST" action="{{ route('auth.forgot_password') }}" class="intro-x mt-8 w-full">
                            @csrf
                            <input type="text" name="email" placeholder="Masukkan email Anda"
                                value="{{ old('email') }}"
                                class="intro-x form-control w-full py-3 block @error('email') border-danger @enderror">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="intro-x mt-5 lg:mt-8 text-center lg:text-left">
                                <button type="submit" class="w-full btn text-white shadow-md"
                                    style="background-color: rgb(0, 38, 35);" id="buttonTambah">
                                    Kirim Kode
                                </button>
                            </div>
                        </form>

                        <a class="mt-4 text-center intro-x underline underline-offset-2" href="{{ route('login') }}">Kembali
                            ke halaman login</a>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>

        @include('layout.partials.scripts')
    </body>
@endsection

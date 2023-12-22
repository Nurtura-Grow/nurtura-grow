@extends('layout.base')

@section('body')
    <body class="flex h-screen p-0 m-0 bg-no-repeat bg-rgb-light-green overflow-hidden">
        <div class="container sm:px-8 lg:px-12 xl:px-24 h-screen">
            <div class="block lg:grid grid-cols-2 gap-4">
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
                <div class="h-screen lg:h-auto flex py-5 px-5 lg:py-0 lg:my-0">
                    <div
                        class="intro-x my-auto flex flex-col mx-auto xl:ml-20 bg-white p-16 rounded-lg shadow-md lg:shadow-none w-full">
                        <h2 class="intro-x font-bold text-2xl lg:text-3xl text-center lg:text-left">
                            Password baru
                        </h2>
                        <p class="intro-x mt-3">
                            Masukkan password baru Anda
                        </p>

                        <form method="POST" action="{{ route('auth.reset_password', ['email' => $email_encrypted]) }}"
                            class="intro-x mt-8 w-full">
                            @csrf
                            <input type="password" name="password" placeholder="Masukkan password Anda"
                                class="intro-x form-control w-full py-3 block">

                            <input type="password" name="password_confirmation" placeholder="Ulangi password Anda"
                                class="intro-x form-control w-full mt-5 py-3 block">

                            <div class="intro-x mt-5 lg:mt-8 text-center lg:text-left">
                                <button type="submit" class="w-full btn text-white shadow-md"
                                    style="background-color: rgb(0, 38, 35);" id="buttonTambah">
                                    Perbarui Password
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

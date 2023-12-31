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
    <body class="flex min-h-screen overflow-hidden p-0 m-0 bg-no-repeat bg-fixed bg-center bg-cover">
        <div class="container px-6 sm:px-24 h-screen">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col h-screen">
                    <a href="{{ route('index') }}" class="-intro-x flex items-center pt-10">
                        <img alt="" class="w-10" src="{{ asset('images/logo.svg') }} ">
                        <span class="text-white text-lg ml-3">NurturaGrow</span>
                    </a>
                    <div class="my-auto">
                        <img alt="" class="-intro-x w-2/3 -mt-16"
                            src="{{ asset('images/illustration/auth/login.svg') }}">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight">
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

                        {{-- Alert --}}
                        @error('login')
                            <div class="col-span-12 mt-3 intro-y">
                                <div class="alert alert-dismissible show box bg-primary text-white flex items-center mb-8"
                                    role="alert">
                                    <span>{{ $message }}</span>
                                    <button type="button" class="btn-close text-white" data-tw-dismiss="alert"
                                        aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button>
                                </div>
                            </div>
                        @enderror
                        {{-- End Alert --}}

                        <form method="POST" action="{{ route('auth.login') }}" class="intro-x mt-8">
                            @csrf
                            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"
                                class="intro-x form-control w-full py-3 block @error('email') border-danger @enderror)">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }} </div>
                            @enderror

                            <input type="password" name="password" placeholder="Password"
                                class="intro-x form-control py-3 px-4 block mt-4 @error('password') border-danger @enderror">
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }} </div>
                            @enderror

                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input name="remember_me" id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                    <label class="cursor-pointer select-none" for="remember-me">Ingat saya</label>
                                </div>
                                <a href="{{ route('password')}}">Lupa Password?</a>
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

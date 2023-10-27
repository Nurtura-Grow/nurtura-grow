@extends('layout.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
@endpush

@section('body')

    <body class="p-0 m-0 relative bg-rgb-light-green">
        @include('guest.navbar')
        {{-- Section 1 --}}
        <section
            class="min-h-[95vh] lg:min-h-[90vh] p-0 m-0 bg-rgb-light-green relative flex flex-col justify-center items-center">
            <div
                class="mt-20 md:mt-15 lg:mt-0 grow grid grid-cols-12 gap-0 lg:gap-6 max-w-screen-xl w-full place-content-center">
                {{-- Kiri --}}
                <div class="-intro-x grid col-span-12 lg:col-span-7 place-content-center p-8 md:p-4 m-0">
                    <h1
                        class="font-extrabold text-3xl md:text-4xl max-lg:text-center lg:text-6xl text-rgb-secondary mb-4 lg:mb-8">
                        NurturaGrow
                    </h1>
                    <p class="text-lg text-justify max-lg:p-4">
                        Kami memahami kekuatan alam dan menggabungkannya dengan inovasi teknologi terkini di
                        NurturaGrow. Kami percaya bahwa tanaman yang dirawat dengan cinta dan teknologi yang tepat akan
                        memberikan hasil terbaik. Oleh karena itu, kami dengan bangga mempersembahkan produk inovatif
                        kami yang menggabungkan kebijaksanaan alam dan kecerdasan buatan melalui solusi otomatisasi
                        pupuk dan air untuk tanaman bawang merah Anda. Dengan NurturaGrow, Anda dapat memastikan bahwa
                        tanaman Anda menerima perawatan dan nutrisi terbaik, sehingga setiap musim tanam menghasilkan
                        hasil yang memuaskan.
                    </p>
                    <div class="mt-8 lg:mt-16 max-lg:flex max-lg:flex-col  max-lg:justify-center max-lg:items-center">
                        <a href="{{ route('register') }}"
                            class="px-12 py-4 max-lg:w-1/2 bg-rgb-secondary text-white font-semibold text-center text-lg rounded-xl
                        border-2  border-rgb-secondary hover:bg-white hover:text-rgb-secondary">
                            Daftar
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-12 py-4 max-lg:my-4 max-lg:w-1/2 lg:ml-12  bg-white text-rgb-secondary font-semibold text-center text-lg  rounded-xl
                        border-2 border-rgb-secondary hover:bg-rgb-secondary hover:text-white">
                            Masuk
                        </a>
                    </div>
                </div>
                {{-- Kanan --}}
                <div
                    class="intro-x grid col-span-12 lg:col-span-5 py-5 lg:py-10 place-content-center lg:place-content-end px-4">
                    <img class="w-auto h-auto" src="{{ asset('images/landing-page/section1.png') }}"
                        alt="Ilustrasi NurturaGrow">
                </div>
            </div>
            {{-- Background Ornament --}}
            <img class="hidden md:block w-full" src="{{ asset('images/background/section1.svg') }}">
            <img class="block md:hidden w-full" src="{{ asset('images/background/section1-small.svg') }}">

        </section>
        {{-- Section 2: Fitur --}}
        <section class="min-h-screen p-0 m-0 bg-white flex flex-col justify-center items-center" id="fitur">
            {{-- Content --}}
            <div class="intro-x grow text-center flex flex-col justify-center items-center p-4">
                <h1
                    class="mt-8 lg:mt-4 text-lg md:text-3xl lg:text-6xl text-rgb-secondary font-bold rounded underline decoration-4 decoration-rgb-mid-green underline-offset-8">
                    Fitur NurturaGrow
                </h1>
                {{-- Fitur 1 --}}
                <div
                    class="flex flex-col lg:flex-row mt-2 lg:mt-10 lg:gap-16 items-center lg:items-start lg:p-8 max-w-screen-lg">
                    <img class="w-auto h-auto" src="{{ asset('images/landing-page/tentang-kami.png') }}" alt="">
                    <div class="text-justify max-lg:p-4">
                        <h1 class="font-bold text-xl lg:text-2xl max-lg:text-center text-rgb-secondary">
                            Lorem Ipsum
                        </h1>
                        <p class="text-lg">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia ipsam nihil adipisci dolorum.
                            Quaerat illo laborum rerum assumenda quos similique cupiditate quas. Nisi excepturi repudiandae
                            voluptate iste ad optio rerum maiores voluptas! Obcaecati vitae dolor modi ex corporis aperiam,
                            perspiciatis repellat minima corrupti ut quod explicabo sit hic ipsam, natus quis in earum
                            architecto nostrum rem molestiae cupiditate dolorum illo nisi. Est tempore quam vel fugit ullam
                            deserunt ipsa reprehenderit earum impedit quasi, sequi neque natus molestias. Corporis numquam
                        </p>
                    </div>
                </div>
                {{-- Fitur 2 --}}
                <div
                    class="flex flex-col lg:flex-row mt-2 lg:mt-10 lg:gap-16 items-center lg:items-start  lg:p-8 max-w-screen-lg">
                    <img class="w-auto h-auto" src="{{ asset('images/landing-page/tentang-kami.png') }}" alt="">
                    <div class="text-justify max-lg:p-4">
                        <h1 class="font-bold text-xl lg:text-2xl max-lg:text-center text-rgb-secondary">
                            Lorem Ipsum
                        </h1>
                        <p class="text-lg">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia ipsam nihil adipisci dolorum.
                            Quaerat illo laborum rerum assumenda quos similique cupiditate quas. Nisi excepturi repudiandae
                            voluptate iste ad optio rerum maiores voluptas! Obcaecati vitae dolor modi ex corporis aperiam,
                            perspiciatis repellat minima corrupti ut quod explicabo sit hic ipsam, natus quis in earum
                            architecto nostrum rem molestiae cupiditate dolorum illo nisi. Est tempore quam vel fugit ullam
                            deserunt ipsa reprehenderit earum impedit quasi, sequi neque natus molestias. Corporis numquam
                        </p>
                    </div>
                </div>
            </div>
        </section>
        {{-- Section 3: Tentang Kami --}}
        <section class="min-h-screen p-0 m-0 bg-white flex flex-col justify-center items-center" id="tentang-kami">
            {{-- Content --}}
            <h1
                class="text-lg md:text-3xl lg:text-6xl text-rgb-secondary font-bold rounded underline decoration-4 decoration-rgb-mid-green underline-offset-8">
                Tentang Kami
            </h1>
            <div
                class="mt-2 lg:mt-10 flex flex-col items-center justify-center lg:flex-row gap-6 lg:gap-12 h-auto w-full max-w-screen-xl p-8">
                <div class="h-auto w-auto">
                    <img class="h-auto w-auto" src="{{ asset('images/landing-page/Reason 1.png') }}" alt="">
                </div>
                <div>
                    <img class="h-auto w-auto" src="{{ asset('images/landing-page/Reason 1.png') }}" alt="">
                </div>
                <div>
                    <img class="h-auto w-auto" src="{{ asset('images/landing-page/Reason 1.png') }}" alt="">
                </div>
            </div>
        </section>

        {{-- Section 4: CTA --}}
        <section class="min-h-[50v] lg:min-h-[80vh] p-0 m-0 bg-rgb-light-green flex flex-col justify-center"
            id="aksi">
            {{-- Background ornament --}}
            <img class="top-0 left-0 w-full" src="{{ asset('images/background/section4.svg') }}" alt="">

            {{-- Content --}}
            <div class="intro-x grow text-center flex flex-col justify-center items-center">
                <div>
                    <h1
                        class="text-lg md:text-3xl lg:text-6xl text-rgb-secondary  font-bold
                                rounded underline decoration-4 decoration-rgb-mid-green underline-offset-8">
                        Gunakan NurturaGrow Sekarang
                    </h1>
                    <p class="mt-4 lg:mt-8 text-md md:text-lg lg:text-2xl font-semibold text-black">
                        Solusi Sederhana untuk Pertanian Luar Biasa
                    </p>
                </div>
                <div class="mt-8 lg:mt-16">
                    <a href="{{ route('register') }}"
                        class="px-8 py-2 lg:px-12 lg:py-4 bg-rgb-secondary text-white font-semibold text-md md:text-lg lg:text-2xl rounded-xl
                            border-2  border-rgb-secondary hover:bg-white hover:text-rgb-secondary">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </section>

        {{-- Section 5: Footer --}}
        <section class="min-h-[5vh] lg:min-h-[10vh] p-0 m-0 bg-rgb-secondary  flex items-center justify-center">
            <p class="intro-x text-md lg:text-lg lg:font-semibold text-white">Dibuat oleh NurturaGrow 2023</p>
        </section>

        @include('layout.partials.scripts')
    </body>
@endsection

@extends('layout.base')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
@endpush

@section('body')

    <body class="p-0 m-0 relative bg-rgb-light-green">
        @include('sweetalert::alert')
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
                    <img class="w-auto h-auto" src="{{ asset('images/illustration/landing-page/section1.png') }}"
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
            <div class="intro-x grow text-center flex flex-col gap-5 justify-center items-center p-4">
                <h1
                    class="mt-8 lg:mt-4 text-lg md:text-3xl lg:text-6xl text-rgb-secondary font-bold rounded underline decoration-4 decoration-rgb-mid-green underline-offset-8">
                    Fitur NurturaGrow
                </h1>

                {{-- Fitur 1 -- Pendataan Lahan dan Penanaman --}}
                <div class="flex flex-col lg:flex-row lg:gap-16 justify-center items-center  lg:p-4 max-w-screen-lg">
                    <img class="w-auto sm:w-1/2 lg:w-1/3" src="{{ asset('images/illustration/landing-page/planting.svg') }}"
                        alt="">
                    <div class="text-justify max-lg:p-4">
                        <h1 class="font-bold text-xl lg:text-2xl max-lg:text-center text-rgb-secondary">
                            Pendataan Lahan dan Penanaman
                        </h1>
                        <p class="text-lg">
                            NurturaGrow memberikan kemudahan kepada para petani dengan fitur pemetaan lokasi lahan yang
                            terintegrasi. Dengan pendataan yang akurat, petani dapat dengan cepat mengidentifikasi area
                            tanaman dan mengelola penanaman secara efisien. Sistem pencatatan penanaman dan informasi
                            hari-hari setelah tanam memberikan wawasan yang berharga, membantu petani mengoptimalkan
                            strategi pertanian mereka untuk hasil panen yang lebih baik.
                        </p>
                    </div>
                </div>

                {{-- Fitur 2 -- Monitoring/Pemantauan Alat --}}
                <div class="flex flex-col lg:flex-row lg:gap-16 justify-center items-center lg:p-4 max-w-screen-lg">
                    <img class="w-auto sm:w-1/2 lg:w-1/3" src="{{ asset('images/illustration/landing-page/monitoring-iot.svg') }}"
                        alt="">
                    <div class="text-justify max-lg:p-4">
                        <h1 class="font-bold text-xl lg:text-2xl max-lg:text-center text-rgb-secondary">
                            Pemantauan Alat
                        </h1>
                        <p class="text-lg">
                            Fitur pemantauan alat NurturaGrow membuka pintu untuk pemahaman yang mendalam tentang kondisi
                            lahan. Petani dapat dengan mudah memantau data sensor seperti kelembaban tanah, suhu, dan
                            tingkat nutrisi. Informasi real-time ini memungkinkan pengambilan keputusan yang cepat dan
                            tepat, memastikan tanaman mendapatkan perawatan yang optimal sesuai dengan kebutuhan mereka.
                        </p>
                    </div>
                </div>

                {{-- Fitur 3 -- Otomatisasi --}}
                <div class="flex flex-col lg:flex-row lg:gap-16 justify-center items-center  lg:p-4 max-w-screen-lg">
                    <img class="w-auto sm:w-1/2 lg:w-1/3" src="{{ asset('images/illustration/landing-page/automation.svg') }}"
                        alt="">
                    <div class="text-justify max-lg:p-4">
                        <h1 class="font-bold text-xl lg:text-2xl max-lg:text-center text-rgb-secondary">
                            Otomatisasi Pengairan dan Rekomendasi Pemupukan
                        </h1>
                        <p class="text-lg">
                            NurturaGrow menyajikan inovasi terkini dengan fitur otomatisasi pengairan yang disesuaikan
                            dengan data sensor dan keputusan cerdas dari machine learning. Sistem ini secara otomatis
                            menyesuaikan tingkat pengairan berdasarkan analisis sensor tanah seperti kelembaban, suhu, dan
                            kebutuhan air tanaman. Selain itu, melalui penggunaan machine learning, NurturaGrow memberikan
                            rekomendasi pemupukan yang tepat waktu dan optimal, mempertimbangkan kondisi tanaman. Dengan
                            pendekatan ini, petani dapat memanfaatkan teknologi untuk meningkatkan efisiensi
                            penggunaan air dan memberikan pupuk tanaman secara presisi, menghasilkan hasil pertanian yang
                            lebih berkualitas dan berkelanjutan.
                        </p>
                    </div>
                </div>

                {{-- Fitur 4 -- Pengaturan Alat Manual --}}
                <div class="flex flex-col lg:flex-row lg:gap-16 justify-center items-center  lg:p-4 max-w-screen-lg">
                    <img class="w-auto sm:w-1/2 lg:w-1/3" src="{{ asset('images/illustration/landing-page/control-iot.svg') }}"
                        alt="">
                    <div class="text-justify max-lg:p-4">
                        <h1 class="font-bold text-xl lg:text-2xl max-lg:text-center text-rgb-secondary">
                            Pengaturan Alat Manual
                        </h1>
                        <p class="text-lg">
                            NurturaGrow memberdayakan petani dengan kemampuan pengendalian alat secara manual yang mudah dan
                            efisien. Melalui platform kami, petani dapat mengatur alat-alat IoT dengan cepat sesuai
                            keinginan mereka, termasuk pengaturan pengairan dan pemupukan. Pengendalian manual ini
                            memberikan fleksibilitas penuh kepada petani untuk merespons perubahan kondisi lahan secara
                            instan, menjadikan proses pertanian lebih adaptif dan responsif.
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
                    <img class="h-auto w-auto" src="{{ asset('images/illustration/landing-page/Reason 1.png') }}"
                        alt="">
                </div>
                <div>
                    <img class="h-auto w-auto" src="{{ asset('images/illustration/landing-page/Reason 1.png') }}"
                        alt="">
                </div>
                <div>
                    <img class="h-auto w-auto" src="{{ asset('images/illustration/landing-page/Reason 1.png') }}"
                        alt="">
                </div>
            </div>
        </section>

        {{-- Section 4: CTA --}}
        <section class="min-h-[30vh] lg:min-h-[80vh] p-0 m-0 bg-rgb-light-green flex flex-col justify-center"
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
        <section class="min-h-[10vh] lg:min-h-[15vh] p-0 m-0 bg-rgb-secondary  flex flex-col items-center justify-center">
            <p class="intro-x text-md lg:text-lg lg:font-semibold text-white">Dibuat oleh NurturaGrow 2023</p>

            <div class="intro-x text-md lg:text-lg text-white mt-3">
                Kredit: Seluruh ilustrasi dibuat oleh <a href="https://www.freepik.com">Freepik.com</a>
            </div>
        </section>

        @include('layout.partials.scripts')
    </body>
@endsection

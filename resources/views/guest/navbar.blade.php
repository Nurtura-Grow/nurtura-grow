{{-- Navbar --}}
<nav class="hidden lg:block sticky top-0 border-b-2 border-rgb-secondary bg-rgb-light-green z-[1000]">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('index') }}" class="flex items-center">
            <img src="{{ asset('images/logo-bg.svg') }}" class="w-8 mr-3" alt="NurturaGrow Logo" />
            <span class="self-center text-2xl font-semibold  text-rgb-secondary whitespace-nowrap">NurturaGrow</span>
        </a>
        <div class="w-full lg:w-auto" id="navbar-default">
            <ul
                class="font-medium text-secondary flex p-4 lg:p-0 mt-4 border rounded-lg  lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 ">
                <li>
                    <a href="#" class="block py-2 pl-3 pr-4 rounded lg:bg-transparent"
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
                    <a href="{{ route('login') }}" class="btn bg-white btn-outline-secondary rounded-xl py-2 pl-3 pr-4">
                        <span class="text-rgb-secondary">Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}"
                        class="btn bg-rgb-secondary text-white border-2 border-rgb-secondary rounded-xl">Daftar</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

{{-- Navbar Mobile --}}
<nav class="w-screen mobile-menu lg:hidden">
    <div class="mobile-menu-bar w-screen">
        <a href="{{ route('dashboard') }}" class="flex mr-auto">
            <img alt="Nurtura Grow" class="w-8" src="{{ asset('images/logo-bg.svg') }}">
            <span class="text-rgb-secondary text-lg ml-3 font-medium">NurturaGrow</span>
        </a>
        <a href="{{ route('login') }}"
            class="btn bg-white btn-outline-secondary py-2 pl-3 pr-4 rounded-xl mr-3">Masuk</a>
        <a href="{{ route('register') }}"
            class="btn bg-rgb-secondary text-white border-2 border-rgb-secondary rounded-xl mr-3">Daftar</a>
        <a href="javascript:;" class="mobile-menu-toggler mr-3"> <i class="fa-solid fa-bars"></i> </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle"
                class="w-8 h-8 text-secondary transform -rotate-90"></i> </a>
        <ul class="scrollable__content py-2">
            <li>
                <a href="#" class="menu" aria-current="page">Beranda</a>
            </li>
            <li>
                <a href="#fitur" class="menu">Fitur</a>
            </li>
            <li>
                <a href="#tentang-kami" class="menu">Tentang Kami</a>
            </li>
            <li>
                <a href="#aksi" class="menu">Panduan</a>
            </li>
        </ul>
    </div>
</nav>

@extends('layout.main')

@section('content')
    @include('layout.components.mobile-menu')

    <div class="flex mt-[4.7rem] md:mt-0">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="{{ route('dashboard') }}" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Nurtura Grow" class="w-10 h-10" src="{{ asset('images/logo.svg') }}">
                {{-- <img alt="Nurtura Grow" class="w-8" src="{{ asset('images/logo-nobg.svg') }}"> --}}
                <span class="hidden xl:block text-white text-xl ml-3 font-medium">Nurtura<span
                        class="text-rgb-secondary">Grow</span></span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                @foreach ($sideMenu['side_menu'] as $menu)
                    <li>
                        {{-- If have sub_menu -> javascript:;, if not, go to the route_name --}}
                        @if ($menu['route_name'] == 'panduan')
                            <a href="https://nurturagrow.gitbook.io/nurturagrow/" target="_blank"
                                class="side-menu {{ $sideMenu['active_first_menu'] == $menu['route_name'] ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i class="{{ $menu['icon'] }}"></i> </div>
                                <div class="side-menu__title"> {{ $menu['title'] }} </div>
                            </a>
                        @else
                            <a href="{{ isset($menu['sub_menu']) ? 'javascript:;' : route($menu['route_name']) }}"
                                class="side-menu {{ $sideMenu['active_first_menu'] == $menu['route_name'] ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i class="{{ $menu['icon'] }}"></i> </div>
                                <div class="side-menu__title"> {{ $menu['title'] }}
                                    @if (isset($menu['sub_menu']))
                                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                    @endif
                                </div>
                            </a>
                        @endif
                        {{-- Sub Menu --}}
                        @if (isset($menu['sub_menu']))
                            <ul
                                class="{{ $sideMenu['active_first_menu'] == $menu['route_name'] ? 'side-menu__sub-open' : '' }}">
                                @foreach ($menu['sub_menu'] as $subMenu)
                                    <li>
                                        <a href="{{ route($subMenu['route_name']) }}"
                                            class="side-menu {{ $sideMenu['active_second_menu'] == $subMenu['route_name'] ? 'side-menu--active' : '' }}">
                                            <div class="side-menu__icon"> <i class="{{ $subMenu['icon'] }}"></i>
                                            </div>
                                            <div class="side-menu__title"> {{ $subMenu['title'] }} </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @include('layout.components.top-bar')

            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection

<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="{{ route('dashboard') }}" class="flex items-center mr-auto">
            <img alt="Nurtura Grow" class="w-10 h-10" src="{{ asset('images/logo.svg') }}">
            {{-- <img alt="Nurtura Grow" class="w-8" src="{{ asset('images/logo-bg.svg') }}"> --}}
            <span class="text-white text-lg ml-3 font-medium">Nurtura<span
                    class="text-rgb-secondary">Grow</span></span>
        </a>
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2"
                class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle"
                class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        <ul class="scrollable__content py-2">
            @foreach ($sideMenu['side_menu'] as $menu)
                <li>
                    <a href="{{ isset($menu['sub_menu']) ? 'javascript:;.html' : route($menu['route_name']) }}"
                        class="menu {{ $sideMenu['active_first_menu'] == $menu['route_name'] ? 'menu--active' : '' }}">
                        <div class="menu__icon"> <i class="{{ $menu['icon'] }}"></i> </div>
                        <div class="menu__title"> {{ $menu['title'] }}
                            @if (isset($menu['sub_menu']))
                                <div class="menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            @endif
                        </div>
                    </a>
                    {{-- Sub Menu --}}
                    @if (isset($menu['sub_menu']))
                        <ul class="{{ $sideMenu['active_first_menu'] == $menu['route_name'] ? 'menu__sub-open' : '' }}">
                            @foreach ($menu['sub_menu'] as $subMenu)
                                <li>
                                    <a href="{{ route($subMenu['route_name']) }}"
                                        class="menu {{ $sideMenu['active_second_menu'] == $subMenu['route_name'] ? 'menu--active' : '' }}">
                                        <div class="menu__icon"> <i class="{{ $subMenu['icon'] }}"></i>
                                        </div>
                                        <div class="menu__title"> {{ $subMenu['title'] }} </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>

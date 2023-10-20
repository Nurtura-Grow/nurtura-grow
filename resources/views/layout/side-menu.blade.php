@extends('layout.main')

@section('content')
    @include('layout.components.mobile-menu')

    {{-- Todo: Add Side Menu --}}
    <div class="flex mt-[4.7rem] md:mt-0">
        <!-- BEGIN: Content -->
        <div class="content">
            @include('layout.components.top-bar')
            <p>Side Menu</p>
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection

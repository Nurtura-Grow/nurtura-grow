<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active text-bold" aria-current="page">
                @if ($sideMenu['first_title'] == 'Tanaman' || $sideMenu['first_title'] == 'Lahan')
                    {{ $sideMenu['second_title'] ?? '' }}
            </li>
        @else
            {{ $sideMenu['first_title'] . ' ' . $sideMenu['second_title'] ?? '' }}</li>
            @endif
        </ol>
    </nav>
    <!-- END: Breadcrumb -->

    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown">
        <div class="flex flex-row items-center" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <p class="hidden sm:block mx-4 text-rgb-secondary font-semibold">{{ Auth::user()->nama }}</p>
            <div class="w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                <img src="{{ asset('images/illustration/landing-page/section1.png') }}">
            </div>
            <p class="block sm:hidden mx-4 text-rgb-secondary font-semibold">{{ Auth::user()->nama }}</p>
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">
                <li class="p-2">
                    <div class="font-medium">{{ Auth::user()->nama }}</div>
                    <div class="text-xs text-rgb-secondary mt-0.5">{{ Auth::user()->username }}</div>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="user"
                            class="w-4 h-4 mr-2"></i> Profile </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="edit"
                            class="w-4 h-4 mr-2"></i> Add Account </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock"
                            class="w-4 h-4 mr-2"></i> Reset Password </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="help-circle"
                            class="w-4 h-4 mr-2"></i> Help </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item w-full hover:bg-white/5">
                            <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->

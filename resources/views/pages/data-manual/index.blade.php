@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto" id="judulHalaman">
            Input Data Manual
        </h2>
    </div>

    <div class="grid grid-cols-12 gap-3 xl:gap-6">
        {{-- Menu Kiri --}}
        <div class="intro-y col-span-12 xl:col-span-3">
            <div class="box mt-5 pb-5 sticky top-10 xl:h-[90vh]">
                <div class="px-4 pt-5">
                    <a class="flex rounded-lg items-center px-4 py-2 bg-primary text-white font-medium" href="#tinggiTanaman">
                        <i class="fa-solid fa-ruler-vertical w-4 h-4 mr-2"></i>
                        <div class="flex-1 truncate">Tinggi Tanaman</div>
                    </a>
                    <a class="flex rounded-lg items-center px-4 py-2 mt-1" href="#pengairan">
                        <i class="w-4 h-4 mr-2 fa-solid fa-faucet-drip"></i>
                        <div class="flex-1 truncate">Pengairan</div>
                    </a>
                    <a class="flex rounded-lg items-center px-4 py-2 mt-1 " href="#pemupukan">
                        <i class="fa-brands fa-pagelines w-4 h-4 mr-2"></i>
                        <div class="flex-1 truncate">Pemupukan</div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Form Kanan --}}
        <div class="intro-y col-span-12  xl:col-span-9">
            @include('pages.data-manual.form-tinggi-tanaman')
            @include('pages.data-manual.form-pengairan')
            @include('pages.data-manual.form-pemupukan')
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Get all the anchor links inside the first div
        const links = document.querySelectorAll('.intro-y .box a');

        // Function to handle scroll event
        function handleScroll() {
            // Loop through all the anchor links
            links.forEach(link => {
                // Get the target element based on the link's href value
                const targetId = link.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                // Get the position of the target element relative to the viewport
                const rect = targetElement.getBoundingClientRect();

                // If the target element is in the viewport, add the specified classes and remove classes from other elements
                if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
                    // Remove classes from other elements
                    links.forEach(otherLink => {
                        if (otherLink !== link) {
                            otherLink.classList.remove('bg-primary', 'text-white', 'font-medium');
                        }
                    });

                    // Add classes to the current link
                    link.classList.add('bg-primary', 'text-white', 'font-medium');
                } else {
                    // If the target element is not in the viewport, remove the specified classes
                    link.classList.remove('bg-primary', 'text-white', 'font-medium');
                }
            });
        }

        // Add scroll event listener to the window
        window.addEventListener('scroll', handleScroll);

        // Initial call to set the classes based on the initial scroll position
        handleScroll();
    </script>
    @vite('resources/js/pages/dataLahan.js')
@endpush

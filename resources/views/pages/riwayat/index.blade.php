@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-5 sm:mt-8 h-10">
        <h2 class="text-lg font-medium  mr-auto" id="judulHalaman">
            Riwayat Tinggi Tanaman
        </h2>
        <div class="w-full sm:w-auto flex mt-2 sm:mt-0">
            <a href="{{ route('manual.tinggi.create') }}" class="btn bg-rgb-secondary text-white shadow-md" id="buttonTambah">
                <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Tinggi Tanaman
            </a>
        </div>
    </div>

    <div class="intro-y box p-5 mt-10 sm:mt-5">
        <div class="overflow-x-auto scrollbar-hidden">
            <ul class="nav nav-link-tabs" role="tablist" id="navigationBar">
                <li id="riwayat-tinggi" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#tinggi"
                        type="button" role="tab" aria-controls="tinggi" aria-selected="true"> Tinggi Tanaman
                    </button>
                </li>

                <li id="riwayat-sensor" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#data-sensor" type="button"
                        role="tab" aria-controls="data-sensor" aria-selected="false"> Data Sensor </button>
                </li>

                <li id="riwayat-pemupukan" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#pemupukan" type="button"
                        role="tab" aria-controls="pemupukan" aria-selected="false"> Pemupukan </button>
                </li>

                <li id="riwayat-pengairan" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#pengairan" type="button"
                        role="tab" aria-controls="pengairan" aria-selected="false"> Pengairan </button>
                </li>
            </ul>

            <div class="tab-content mt-5 w-full">
                <div id="tinggi" class="tab-pane leading-relaxed active w-full" role="tabpanel"
                    aria-labelledby="riwayat-tinggi">
                    @include('pages.riwayat.tinggi-tanaman')
                </div>
                <div id="data-sensor" class="tab-pane leading-relaxed w-full" role="tabpanel"
                    aria-labelledby="riwayat-sensor">
                    @include('pages.riwayat.data-sensor')
                </div>

                <div id="pemupukan" class="tab-pane leading-relaxed w-full" role="tabpanel"
                    aria-labelledby="riwayat-pemupukan">
                    @include('pages.riwayat.pemupukan')
                </div>
                <div id="pengairan" class="tab-pane leading-relaxed w-full" role="tabpanel"
                    aria-labelledby="riwayat-pengairan">
                    @include('pages.riwayat.pengairan')
                </div>
            </div>
        </div>
    </div>
@endsection

@include('pages.components.datatable-styles')
@push('scripts')
    <script>
        const judulHalaman = document.getElementById('judulHalaman');
        const buttonTambah = document.getElementById('buttonTambah')
        const navigationBar = document.getElementById('navigationBar');

        const navButtons = navigationBar.querySelectorAll('.nav-link');

        navButtons.forEach(button => {
            button.addEventListener('click', () => {
                buttonTambah.innerHTML = '<i class="fa-solid fa-circle-plus mr-2"></i>' + 'Tambah' + button
                    .textContent + 'Manual';

                var routeName;
                if (button.textContent == " Tinggi Tanaman ") {
                    routeName = "{{ route('manual.tinggi.create') }}";
                } else if (button.textContent == " Pemupukan ") {
                    routeName = "{{ route('manual.pemupukan.create') }}";
                } else if (button.textContent == " Pengairan ") {
                    routeName = "{{ route('manual.pengairan.create') }}";
                } else {
                    // Default case if none of the above conditions are met
                    routeName = ''; // or provide a default value
                }

                buttonTambah.setAttribute('href', routeName);
                judulHalaman.textContent = 'Riwayat ' + button.textContent;
            });
        });

        // Handle resize
        window.addEventListener('resize', function() {
            document.querySelectorAll('.tab-pane').forEach(tab => {
                tab.style.width = '100%';
            });
        })
    </script>
@endpush

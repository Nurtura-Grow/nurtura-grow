@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8 h-10">
        <h2 class="text-lg font-medium truncate mr-auto" id="judulHalaman">
            Riwayat Tinggi Tanaman
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{ route('manual.tinggi.create') }}" class="btn bg-rgb-secondary text-white shadow-md" id="buttonTambah">
                <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Tinggi Tanaman
            </a>
        </div>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="overflow-x-auto scrollbar-hidden">
            <ul class="nav nav-link-tabs" role="tablist" id="navigationBar">
                <li id="riwayat-tinggi" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#tinggi"
                        type="button" role="tab" aria-controls="tinggi" aria-selected="true"> Tinggi Tanaman
                    </button>
                </li>

                <li id="riwayat-pemupukan" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#pemupukan" type="button"
                        role="tab" aria-controls="pemupukan" aria-selected="false"> Pemupukan </button>
                </li>

                <li id="riwayat-pengairan" class="nav-item flex-1" role="presentation"> <button class="nav-link w-full py-2"
                        data-tw-toggle="pill" data-tw-target="#pengairan" type="button" role="tab"
                        aria-controls="pengairan" aria-selected="false"> Pengairan </button> </li>
            </ul>

            <div class="tab-content mt-5">
                <div id="tinggi" class="tab-pane leading-relaxed active w-full" role="tabpanel"
                    aria-labelledby="riwayat-tinggi">
                    <div class="w-full overflow-x-hidden">
                        @include('pages.riwayat.tinggi-tanaman')
                    </div>
                </div>
                <div id="pemupukan" class="tab-pane leading-relaxed w-full" role="tabpanel"
                    aria-labelledby="riwayat-pemupukan">
                    <div class="w-full overflow-x-hidden">
                        @include('pages.riwayat.pemupukan')
                    </div>
                </div>
                <div id="pengairan" class="tab-pane leading-relaxed w-full" role="tabpanel"
                    aria-labelledby="riwayat-pengairan">
                    <div class="w-full overflow-x-hidden">
                        @include('pages.riwayat.pengairan')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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

                switch (button.textContent) {
                    case "Tinggi Tanaman":
                        routeName = '{{ route('manual.tinggi.create') }}';
                        break;

                    case "Pemupukan":
                        routeName = '{{ route('manual.pemupukan.create') }}';
                        break;

                    case "Pengairan":
                        routeName = '{{ route('manual.pengairan.create') }}';
                        break;
                }

                buttonTambah.setAttribute('href', routeName);
                judulHalaman.textContent = 'Riwayat ' + button.textContent;
            });
        });
    </script>
@endpush
@include('pages.components.datatable-styles')

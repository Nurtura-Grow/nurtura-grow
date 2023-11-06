@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto" id="judulHalaman">
            Riwayat Tinggi Tanaman
        </h2>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="overflow-x-auto scrollbar-hidden">
            <ul class="nav nav-link-tabs" role="tablist" id="navigationBar">
                <li id="riwayat-tinggi-tanaman" class="nav-item flex-1" role="presentation"> <button
                        class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="tinggi-tanaman"
                        type="button" role="tab" aria-controls=tinggi-tanaman" aria-selected="true"> Tinggi Tanaman
                    </button> </li>
                <li id="riwayat-pemupukan" class="nav-item flex-1" role="presentation"> <button class="nav-link w-full py-2"
                        data-tw-toggle="pill" data-tw-target="#pemupukan" type="button" role="tab"
                        aria-controls="pemupukan" aria-selected="false"> Pemupukan </button> </li>
                <li id="riwayat-pengairan" class="nav-item flex-1" role="presentation"> <button class="nav-link w-full py-2"
                        data-tw-toggle="pill" data-tw-target="#pengairan" type="button" role="tab"
                        aria-controls="pengairan" aria-selected="false"> Pengairan </button> </li>
            </ul>

            <div class="tab-content mt-5">
                <div id=tinggi-tanaman" class="tab-pane leading-relaxed active" role="tabpanel"
                    aria-labelledby="riwayat-tinggi-tanaman">
                    @include('pages.riwayat.tinggi-tanaman')
                </div>
                <div id="pemupukan" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="riwayat-pemupukan">
                    @include('pages.riwayat.pemupukan')
                </div>
                <div id="pengairan" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-7-tab">
                    @include('pages.riwayat.pengairan')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const judulHalaman = document.getElementById('judulHalaman');
        const navigationBar = document.getElementById('navigationBar');
        const navButtons = navigationBar.querySelectorAll('.nav-link');

        navButtons.forEach(button => {
            button.addEventListener('click', () => {
                judulHalaman.textContent = 'Riwayat ' + button.textContent;
            });
        });
    </script>
@endpush
@include('pages.components.datatable-styles')

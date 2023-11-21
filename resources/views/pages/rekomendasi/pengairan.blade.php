@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Rekomendasi Pengairan
        </h2>
    </div>

    {{-- Wanna change layout? gambar kiri, kanan grafik + action --}}
    {{-- <div class="flex flex-col min-h-[68vh] lg:flex-row mt-5 gap-4">
        <div class="intro-y basis-1/2 box p-5">
            ini gambar
        </div>
        <div class="basis-1/2 flex flex-col gap-3">
            <div class="intro-y basis-1/2 box p-5">
                ini grafik
            </div>
            <div class="intro-y basis-1/2 box p-5">
                ini action
            </div>
        </div>
    </div> --}}

    <div class="flex flex-col min-h-[68vh] mt-5 gap-4">
        <div class="intro-y grow basis-1/2 box p-5">
            ini gambar
        </div>
        <div class="intro-y grow basis-1/2 flex flex-col lg:flex-row gap-3">
            <div class="basis-1/2 box p-5">
                ini grafik
            </div>
            <div class="intro-y basis-1/2 box p-5">
                ini action
            </div>
        </div>
    </div>
@endsection

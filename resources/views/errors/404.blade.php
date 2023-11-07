@extends('layout.main')

@section('content')
    <div class="content h-[90vh]">
        <div class="grid grid-cols-12 justify-center items-center h-full">
            <div class="col-span-6 mx-auto">
                <img src="{{ asset('images/error/404.png') }}" alt="404">
            </div>
            <div class="text-center col-span-6">
                <h1 class="text-6xl font-bold">404</h1>
                <p class="text-2xl font-light mb-10 mt-2">Halaman tidak ditemukan</p>
                <a href="{{ route('index') }}" class="btn btn-primary font-bold py-2 px-4 rounded">
                    Kembali ke halaman awal
                </a>
            </div>
        </div>
    </div>
@endsection

@extends('layout.main')

@section('content')
    <div class="content h-[90vh]">
        <div class="grid grid-cols-12 justify-center items-center h-full">
            <div class="text-center col-span-12">
                <h1 class="text-6xl font-bold">500 - Terjadi Kesalahan </h1>
                <p class="text-2xl font-light mb-10 mt-2">{{ $exception->getMessage() }}</p>
                <a href="{{ route('index') }}" class="btn btn-primary font-bold py-2 px-4 rounded">
                    Kembali ke halaman awal
                </a>
            </div>
        </div>
    </div>
@endsection

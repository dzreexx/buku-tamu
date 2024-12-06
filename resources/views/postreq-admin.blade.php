@extends('layouts.admin')
@section('content')
<div class="flex justify-center items-center h-screen">
    <div class="card w-96 bg-base-100 shadow-xl">
        <figure><img src="{{ asset('images/logomabestni.png') }}" class="size-2/3" alt="TNI AL" /></figure>
        <div class="card-body flex items-center justify-center">
            <h2 class="card-title">TAMU</h2>
            <h2 class="card-title">MABESAL</h2>
            <h2 class="card-title">{{ $guest->ticket->number }}</h2>
            <p class="mt-4">Serahkan device ini ke petugas</p>
            <p class="mt-4">dan ambil kartu anda</p>
        </div>
    </div>
</div>
<div class="flex justify-center items-center h-screen">
    <div class="card w-96 bg-base-100 shadow-xl">
        <figure><img src="{{ empty($guest->user_id) ? route("display.guest", $guest->selfie_path) : route("display.profile", $guest->selfie_path) }}" alt="Selfie" /></figure>
        <div class="card-body">
            <ul class="list-none p-0">
                <li class="flex justify-between border-b border-gray-300 py-2">
                    <span class="font-bold">Nama:</span>
                    <span>{{ $guest->nama }}</span>
                </li>
                <li class="flex justify-between border-b border-gray-300 py-2">
                    <span class="font-bold">Telp:</span>
                    <span>0{{ $guest->telp }}</span>
                </li>
                <li class="flex justify-between border-b border-gray-300 py-2">
                    <span class="font-bold">Nik:</span>
                    <span>{{ $guest->nik }}</span>
                </li>
                <li class="flex justify-between border-b border-gray-300 py-2">
                    <span class="font-bold">Masuk:</span>
                    <span>{{ $guest->check_in_at }}</span>
                </li>
                <li class="flex justify-between border-b border-gray-300 py-2">
                    <span class="font-bold">Keluar:</span>
                    <span>{{ $guest->check_out_at }}</span>
                </li>
            </ul>
            <p class="mt-4 font-bold">Keterangan: </p>
            <p>{{ $guest->ket }}</p>
        </div>
    </div>
</div>
@endsection

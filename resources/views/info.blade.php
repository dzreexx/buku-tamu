@extends('layouts.user')

@section('content')

{{-- <div class="hero min-h-screen bg-cover bg-center" style="background-image: url('images/disinfolahtal.png');">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold">Informasi TNI AL</h1>
            <p class="mb-5">Temukan informasi terkini mengenai jadwal kerja dan acara di lingkungan TNI Angkatan Laut.</p>
        </div>
    </div>
</div> --}}

<main class="container mx-auto p-4">
    <section id="jadwal" class="my-8">
        <h2 class="text-2xl font-bold mb-4">Jadwal Kunjungan</h2>
        <div class="bg-white shadow-md rounded-lg p-6">
            <p><b>Senin - Sabtu:</b> 10:00 - 15:00</p>
            <p><b>Minggu:</b> Tidak ada kunjungan</p>
        </div>
    </section>

    <section id="acara" class="my-8">
        <h2 class="text-2xl font-bold mb-4">Pengumuman Acara</h2>
        @if ($infos)
        @foreach ($infos as $info)
        <div tabindex="0" class="mt-3 collapse collapse-arrow border border-base-300 bg-info">
            <div class="collapse-title text-xl font-medium">
              {{ $info->nama }}
            </div>
            <div class="collapse-content"> 
                    <p><b>Keterangan: </b>{{ $info->ket }}</p>
                    <p><b>Lokasi: </b>{{ $info->lokasi }}</p>
                    <p><b>Tanggal: </b>{{ \Carbon\Carbon::parse($info->tanggal)->locale('id')->translatedFormat('l, d F Y') }}</p>
            </div>
          </div>
        @endforeach
        @else
            <div>
                <small>Tidak ada pengumuman</small>
            </div>
        @endif
    </section>
</main>


@endsection

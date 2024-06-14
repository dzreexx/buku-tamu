@extends('layouts.user')

@section('content')

<!-- Main Content -->
<main class="container mx-auto px-4 py-10">
    <article class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $berita->judul }}</h2>
        <small class="text-gray-600 mb-6">Ditulis oleh <span class="font-bold">{{ $berita->user->nama }}</span> pada <span class="font-bold">{{ $berita->formatted_date }}</span></small>
        @if ($berita->thumb_path)
        <img src="{{ asset('storage/'.$berita->thumb_path) }}" alt="Gambar Berita" class="w-full h-64 object-cover object-center mb-6 rounded-lg">
        @else
        <img src="/images/disinfolahtal.png" alt="Gambar Berita" class="w-full h-64 object-cover object-center mb-6 rounded-lg">
        @endif
        <p class="text-gray-700 mb-4">{!! $berita->body !!}</p>
    </article>
</main>

@endsection
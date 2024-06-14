@extends('layouts.admin')

@section('content')

<!-- Main Content -->
<main class="container mx-auto px-4 py-10">
    <article class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $info->judul }}</h2>
        <small class="text-gray-600 mb-6">Ditulis oleh <span class="font-bold">{{ $info->user->nama }}</span> pada <span class="font-bold">{{ \Carbon\Carbon::parse($info->created_at)->locale('id')->translatedFormat('l, d F Y') }}</span></small>
        @if ($info->thumb_path)
        <img src="{{ asset('storage/'.$info->thumb_path) }}" alt="Gambar Berita" class="w-full h-64 object-cover object-center mb-6 rounded-lg">
        @else
        <img src="/images/disinfolahtal.png" alt="Gambar Berita" class="w-full h-64 object-cover object-center mb-6 rounded-lg">
        @endif
        <p class="text-gray-700 mb-4">{!! $info->body !!}</p>
    </article>
    <div class="mt-5 flex justify-between">
        <div>
            <a class="link link-info" href="/admin/berita">Kembali</a>
        </div>
        <div class="flex justify-end">
            <button type="button" class="btn btn-error mr-3" onclick="showDeleteModal()">Hapus Berita</button>
            <a href="/admin/berita/{{ $info->id }}/edit" class="btn btn-info">Rubah Berita</a>
        </div>
    </div>
</main>

<!-- Modal Konfirmasi -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Anda yakin ingin menghapus?</h2>
        <div class="flex justify-end">
            <button id="cancelButton" class="btn mr-3">Batalkan</button>
            <form id="deleteForm" action="/admin/berita/{{ $news->id }}/hapus" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-error">Konfirmasi</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showDeleteModal() {
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.classList.remove('hidden');
    }

    document.getElementById('cancelButton').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.add('hidden');
    });

    window.addEventListener('click', function(event) {
        const deleteModal = document.getElementById('deleteModal');
        if (event.target == deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    });
</script>

@endsection

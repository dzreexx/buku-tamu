@extends('layouts.user')

@section('content')

{{-- ini adalah tampilan konten utama --}}
@if(Auth::user() && $user->is_admin == '')
<div role="alert" id="notif" class="alert alert-info mb-5">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
  <span>Akun mu belum diverifikasi oleh admin.</span>
  <div onclick="tutupNotif()">
    <button class="btn btn-sm">tutup</button>
  </div>
</div>
@endif
@if ($news->count())    
<div class="hidden md:flex items-center justify-center max-h-screen bg-base-200">
  <div class="flex max-h-screen w-full">
    <img class="w-1/2 h-auto max-h-screen object-cover" src="{{ asset('storage/'. $news[0]->thumb_path) }}" alt="Berita">
    {{-- <img class="w-1/2 h-auto max-h-screen object-cover" src="https://source.unsplash.com/1200x400/?{{ $news[0]->judul }}" alt=""> --}}
    <div class="hero-content text-center w-1/2 flex items-center justify-center">
      <div class="max-w-md text-left">
        <h1 class="text-5xl font-bold">{{ $news[0]->judul }}</h1>
        <p class="py-6">{{ $news[0]->excerpt }}</p>
        <div class="card-actions justify-end">
          <small>{{ $news[0]->created_at->diffForHumans() }}</small> 
        </div>
        <div class="mt-2 card-actions justify-end">
          <a href="/berita/{{ $news[0]->id }}" class="btn btn-neutral">Baca Selengkapnya</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="hidden md:flex flex-wrap mt-3 items-center justify-center">
  @foreach ($news->skip(1) as $new)    
  <div class="card m-12 w-1/4 bg-base-100 shadow-xl">
    <figure><img src="{{ asset('storage/'. $new->thumb_path) }}" alt="Berita" /></figure>
    <div class="card-body">
      <h2 class="card-title">
        {{ $new->judul }}
      </h2>
      <p>{{ $new->excerpt }}</p>
      <div class="card-actions">
      <small>{{ $new->created_at->diffForHumans() }}</small> 
      </div>
      <div class="card-actions justify-end">
        <a href="/berita/{{ $new->id }}" class="btn btn-neutral">Baca Selengkapnya</a>
      </div>
    </div>
  </div>
  @endforeach
</div>

@else
<p class="text-center">Belum ada berita.</p>
@endif
{{-- ini untuk tampilan mobile --}}

<div class="block md:hidden">
  @foreach ($news as $new) 
  <div class="card w-2/1 bg-base-100 shadow-xl m-2 ">
    <figure><img src="{{ asset('storage/'. $new->thumb_path) }}" alt="Shoes" /></figure>
    <div class="card-body">
      <h2 class="card-title">
        {{ $new->judul }}
      </h2>
      <p>{{ $new->excerpt }}</p>
      <div class="card-actions flex justify-between">
        <small>{{ $news[0]->created_at->diffForHumans() }}</small>
        <a href="" class="btn btn-neutral">Baca Selengkapnya</a>
      </div>
    </div>
  </div>
  @endforeach
</div>

<div class="container">
  {{ $news->links('vendor.pagination.default') }}
  {{-- {{ $news->links('vendor.pagination.bootstrap-4') }} --}}
</div>


<script>
  function tutupNotif() {
    var notif = document.getElementById("notif");
    notif.classList.toggle("hidden");
  }
</script>
@endsection
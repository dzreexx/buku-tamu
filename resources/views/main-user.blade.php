@extends('layouts.user')

@section('content')
@if(Auth::user() && $user->is_admin == '')
<div role="alert" id="notif" class="alert alert-info mb-5">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
  <span>Akun mu belum diverifikasi oleh admin.</span>
  <div onclick="tutupNotif()">
    <button class="btn btn-sm">tutup</button>
  </div>
</div>
@endif
<section class="bg-white dark:bg-gray-900">
  <div class="py-4 px-4 mx-auto max-w-screen-xl lg:px-0 lg:py-4 ">
      <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
          <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Berita</h2>
          {{-- <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Temukan berita terbaru dari Disinfolahtal Mabes TNI AL.</p> --}}
      </div> 
      @php
          $newsCount = $news->count();
          $gridCols = 'lg:grid-cols-1';
          if ($newsCount == 2) {
              $gridCols = 'lg:grid-cols-2';
          } elseif ($newsCount >= 3) {
              $gridCols = 'lg:grid-cols-3';
          }
      @endphp
      <div class="grid gap-8 {{ $gridCols }} md:grid-cols-2">
        @foreach ($news as $new)
        <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-5 text-gray-500">
                {{-- <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                    <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                    Tutorial
                </span> --}}
                <span class="text-sm">{{ $new->created_at->diffForHumans() }}</span>
            </div>
            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:underline"><a href="/berita/{{ $new->id }}">{{ $new->judul }}</a></h2>
            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ $new->excerpt }}</p>
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img class="w-7 h-7 rounded-full" src="{{ route('display.profile', $new->user->img_path) }}" alt="Jese Leos avatar" />
                    <span class="font-medium dark:text-white">
                        {{ $new->user->nama }}
                    </span>
                </div>
                <a href="/berita/{{ $new->id }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                    Baca Selengkapnya
                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
        </article>                               
        @endforeach
      </div>  
  </div>
</section>

<div class="container mt-10">
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
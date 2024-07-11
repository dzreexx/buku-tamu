@extends('layouts.user')

@section('content')

{{-- <main class="container mx-auto px-4 py-10">
    <article class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $berita->judul }}</h2>
        <small class="text-gray-600 mb-6">Ditulis oleh <span class="font-bold">{{ $berita->user->nama }}</span> pada <span class="font-bold">{{ $berita->formatted_date }}</span></small>
        @if ($berita->thumb_path)
        <img src="{{ route('display.news',$berita->thumb_path) }}" alt="Gambar Berita" class="w-full h-64 object-cover object-center mb-6 rounded-lg">
        @else
        <img src="/images/disinfolahtal.png" alt="Gambar Berita" class="w-full h-64 object-cover object-center mb-6 rounded-lg">
        @endif
        <p class="text-gray-700 mb-4">{!! $berita->body !!}</p>
    </article>
</main> --}}

<!-- 
Install the "flowbite-typography" NPM package to apply styles and format the article content: 

URL: https://flowbite.com/docs/components/typography/ 
-->

<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
        <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <header class="mb-4 lg:mb-6 not-format">
                <address class="flex items-center mb-6 not-italic">
                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                        <img class="mr-4 w-16 h-16 rounded-full" src="{{ route('display.profile', $berita->user->img_path) }}" alt="Jese Leos">
                        <div>
                            <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $berita->user->nama }}</a>
                            {{-- <p class="text-base text-gray-500 dark:text-gray-400">Graphic Designer, educator & CEO Flowbite</p> --}}
                            <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022">{{ date('Y-m-d', strtotime($berita->created_at)) }}</time></p>
                            <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022">{{ $berita->created_at->diffForHumans() }}</time></p>
                        </div>
                    </div>
                </address>
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $berita->judul }}</h1>
            </header>
            <figure><img src="{{ route('display.news',$berita->thumb_path) }}" alt="">
                {{-- <figcaption>Digital art by Anonymous</figcaption> --}}
            </figure>
            <p class="text-gray-700 mb-4">{!! $berita->body !!}</p>
            <div class="mt-10">
                <a href="/" class="text-blue-600">&laquo; Kembali</a>
            </div>
        </article>
    </div>
  </main>
  

@endsection
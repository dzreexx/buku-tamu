@extends('layouts.user')

@section('content')

<h1>
    &lsaquo;
</h1>
<h1>
    &lt;
</h1>
<div class="artboard artboard-horizontal phone-3">
    <img src="{{ asset('storage/'.$berita->thumb_path) }}" alt="">
</div>
<h1>
    {{ $berita->id }}
</h1>
<h1 class="font-bold">
    {{ $berita->judul }}
</h1>
<h1>
    {{ $berita->body }}
</h1>

@endsection
@extends('layouts.admin')

@section('content')
<form action="/admin/berita/buat" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf
<div class="my-4">
    <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Judul Berita</span>
        </div>
        <input type="text" id="judul" name="judul" placeholder="Type here" class="input @error('judul') input-error @enderror input-bordered w-full max-w-xs" />
        @error('judul')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
        @enderror
    </label>
</div>
<div class="my-4">
    <div class="label">
        <span class="label-text">Sampul Berita</span>
    </div>
    <input type="file" id="thumbnail" name="thumbnail" class="file-input @error('thumbnail') input-error @enderror file-input-bordered w-full max-w-xs" />
    @error('thumbnail')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
    @enderror
</div>
<div class="my-4">
    <label for="body">
        <span class="label-text">Isi Berita</span>
            <input id="body" type="hidden" name="body">
            <trix-editor input="body"></trix-editor>
            @error('body')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
            @enderror
    </label>
</div>
<div class="flex justify-center">
    <button type="submit" class="btn btn-neutral">Kirim</button>
</div>
</form>

<script src="/js/trix.js"></script>

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDevault();
    })
</script>

@endsection
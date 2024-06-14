@extends('layouts.admin')

@section('content')
<form action="/admin/berita/{{ $news->id }}/edit" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf
<div class="my-4">
    <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Judul Berita</span>
        </div>
        <input type="text" id="judul" name="judul" placeholder="Type here" class="input @error('judul') input-error @enderror input-bordered w-full max-w-xs" value="{{ old('judul',$news->judul) }}"/>
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
    <input type="file" id="thumbnail" name="thumbnail" class="file-input @error('thumbnail') input-error @enderror file-input-bordered w-full max-w-xs" value="{{ old('thumbnail', $news->thumb_path) }}"/>
    @error('thumbnail')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
    @enderror

    <!-- Preview gambar -->
    @if ($news->thumb_path)
    <div class="mt-4">
        <img id="thumbnail-preview" src="{{ asset('storage/'.$news->thumb_path) }}" alt="Preview Thumbnail" style="max-width: 300px;">
    </div>
    @else
        <div class="mt-4">
            <img id="thumbnail-preview" src="/images/disinfolahtal.png" alt="Preview Thumbnail" style="max-width: 300px;">
        </div>
    @endif
</div>

<div class="my-4">
    <label for="body">
        <span class="label-text">Isi Berita</span>
            <input id="body" type="hidden" name="body" value="{{ old('body', $news->body) }}">
            <trix-editor input="body"></trix-editor>
            @error('body')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
            @enderror
    </label>
</div>
<div class="flex justify-center">
    <button type="submit" class="btn btn-neutral">Perbarui</button>
</div>
</form>

<script src="/js/trix.js"></script>

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });

    document.getElementById('thumbnail').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('thumbnail-preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection

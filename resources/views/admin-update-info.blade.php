@extends('layouts.admin')

@section('content')
<form action="/admin/informasi/{{ $info->id }}/ubah" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf
<div class="my-4">
    <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Judul Pengumuman</span>
        </div>
        <input type="text" id="nama" name="nama" placeholder="Type here" class="input @error('nama') input-error @enderror input-bordered w-full max-w-xs" value="{{ old('nama', $info->nama) }}" />
        @error('nama')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
        @enderror
    </label>
</div>
<div class="my-4">
    <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Lokasi</span>
        </div>
        <input type="text" id="lokasi" name="lokasi" placeholder="Type here" class="input @error('lokasi') input-error @enderror input-bordered w-full max-w-xs" value="{{ old('lokasi', $info->lokasi) }}"/>
        @error('lokasi')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
        @enderror
    </label>
</div>
<div class="my-4">
    <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Tanggal</span>
        </div>
        <input type="date" id="tanggal" name="tanggal" placeholder="Type here" class="input @error('tanggal') input-error @enderror input-bordered w-full max-w-xs"  value="{{ old('tanggal', $info->tanggal) }}"/>
        @error('tanggal')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
        @enderror
    </label>
</div>
<div class="my-4">
    <label class="form-control w-full max-w-xs">
        <div class="label">
          <span class="label-text">Keterangan</span>
        </div>
        <textarea placeholder="Deskripsi" id="ket" name="ket" class="textarea textarea-bordered textarea-lg w-full max-w-xs" >{{ old('ket', $info->ket) }}</textarea>
        @error('ket')    
        <div class="label">
            <span class="label-text-alt text-red-700">{{ $message }}</span>
        </div>
        @enderror
    </label>
</div>
<div>
    <button type="submit" class="btn btn-neutral">Perbarui</button>
</div>
</form>

<script src="/js/trix.js"></script>

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDevault();
    })
</script>

@endsection
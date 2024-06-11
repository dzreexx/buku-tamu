@extends('layouts.user')

@section('content')
<div class="flex justify-center">
    <div class="">
      <form action="/user/profile/edit" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="rounded-full overflow-hidden w-64 h-64">
            <a href="{{ asset("storage/". auth()->user()->img_path) }}" data-baguettebox="gallery">
                <img id="preview-image" class="w-full h-full object-cover" src="{{ asset("storage/". auth()->user()->img_path) }}" alt="">
            </a>
        </div>
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text">Ubah Foto Anda</span>
          </div>
          <input type="file" name="img_profile" id="img_profile" class="file-input file-input-bordered w-full max-w-xs" onchange="previewImage(event)" />
        </label>
        <label class="form-control w-full max-w-xs">
            <div class="label">
              <span class="label-text">Nama</span>
            </div>
            <input type="text" placeholder="Type here" name="nama" id="nama" class="input input-bordered w-full max-w-xs" value="{{ auth()->user()->nama }}"/>
          </label>
        <label class="form-control w-full max-w-xs">
            <div class="label">
              <span class="label-text">Email</span>
            </div>
            <input type="text" placeholder="Type here" name="email" id="email" class="input input-bordered w-full max-w-xs" value="{{ auth()->user()->email }}"/>
          </label>
          <div class="label">
            <span class="label-text">No Telpon</span>
          </div>
          <label class="input input-bordered flex items-center gap-2 w-full max-w-xs">
            +62
            <input type="text" class="grow" placeholder="Daisy" name="telp" id="telp" value="{{ auth()->user()->telp }}"/>
          </label>
        <label class="form-control w-full max-w-xs">
            <div class="label">
              <span class="label-text">NIK</span>
            </div>
            <input type="text" placeholder="Type here" name="nik" id="nik" class="input input-bordered w-full max-w-xs" value="{{ auth()->user()->nik }}"/>
          </label>
        <label class="form-control w-full max-w-xs">
            <div class="label">
              <span class="label-text">Password</span>
            </div>
            <input type="password" placeholder="Ubah Password baru" name="password" id="password" class="input input-bordered w-full max-w-xs" />
          </label>
          <div class="flex justify-center mt-5">
              <button type="submit" class="btn btn-neutral">Simpan</button>
          </div>
      </form>
    </div>
</div>
<script>
  function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function() {
          var output = document.getElementById('preview-image');
          output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
  }
  </script>
@endsection

@extends('layouts.user')

@section('content')
<div class="flex justify-center">
    <div class="">
        <div class="rounded-full overflow-hidden w-60 h-60">
            <a href="{{ asset("storage/". auth()->user()->img_path) }}" data-baguettebox="gallery">
                <img class="w-full h-full object-cover" src="{{ asset("storage/". auth()->user()->img_path) }}" alt="">
            </a>
        </div>
        <label class="form-control w-full max-w-xs">
            <div class="label">
              <span class="label-text">Nama</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" readonly value="{{ auth()->user()->nama }}"/>
          </label>
        <label class="form-control w-full max-w-xs">
            <div class="label">
              <span class="label-text">Email</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" readonly value="{{ auth()->user()->email }}"/>
          </label>
          <div class="label">
            <span class="label-text">No Telpon</span>
          </div>
          <label class="input input-bordered flex items-center gap-2 w-full max-w-xs">
            +62
            <input type="text" class="grow" placeholder="Daisy" value="{{ auth()->user()->telp }}" readonly/>
          </label>
        <label class="form-control w-full max-w-xs">
            <div class="label">
              <span class="label-text">NIK</span>
            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" readonly value="{{ auth()->user()->nik }}"/>
          </label>
          <div class="flex justify-center mt-5">
              <a href="/user/profile/edit" class="btn btn-neutral">Ubah Profil</a>
          </div>
    </div>
</div>
@endsection

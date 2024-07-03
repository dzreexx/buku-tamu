@extends('layouts.admin')

@section('content')
@if (session('success'))    
<div role="alert" class="alert alert-success mb-3">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    class="h-6 w-6 shrink-0 stroke-current"
    fill="none"
    viewBox="0 0 24 24">
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{ session('success') }}</span>
</div>
@endif
<div class="container">
  <div class="search">
      <input id="search" name="search" type="text" placeholder="Cari berita berdasarkan apa saja" class="input input-bordered w-full mb-5" />
  </div>
</div>

<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>No.</th>
          <th>Pengumuman</th>
          <th>Keterangan</th>
          <th>Lokasi</th>
          <th>Tanggal</th>
          <th>Ubah</th>
          <th>Hapus</th>
        </tr>
      </thead>
      <tbody id="alldata">
        @foreach ($infos as $info)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <th>{{ $info->nama }}</th>
          <th>{{ $info->ket }}</th>
          <th>{{ $info->lokasi }}</th>
          <th>{{ \Carbon\Carbon::parse($info->tanggal)->locale('id')->translatedFormat('d F Y') }}</th>
          <th><a href="/admin/informasi/{{ $info->id }}/ubah" class="btn btn-info">Ubah</a></th>
          <form action="/admin/informasi/{{ $info->id }}/hapus" method="post">
            @method('delete')
            @csrf
            <th>
              <button type="submit" class="btn btn-error">
                Hapus
              </button>
            </th>
          </form>
        </tr>
        @endforeach
      </tbody>
      <tbody id="contentsearch" class="searchdata"></tbody>
    </table>
    <div class="flex justify-center mt-3">
      <a href="/admin/informasi/buat" class="btn btn-neutral">Buat Pengumuman</a>
  </div>
  </div>

  <script>
     $('#search').on('keyup',function () 
  {
    $value=$(this).val();

    if($value)
    {
      $('#alldata').hide();
      $('.searchdata').show();
    } else{
      $('#alldata').show();
      $('.searchdata').hide();
    }

    $.ajax({
      type:'get',
      url:'{{ URL::to('/admin/informasi/search') }}',
      data:{'search':$value},

      success:function(data)
      {
        console.log(data);
        $('#contentsearch').html(data);
      }
    })
  })
  </script>


@endsection
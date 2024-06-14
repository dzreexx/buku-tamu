@extends('layouts.admin')

@section('content')
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
          <th>Judul</th>
          <th>Isi</th>
          <th>Dibuat</th>
          <th>Detail</th>
          <th>Hapus</th>
        </tr>
      </thead>
      <tbody id="alldata">
        @foreach ($news as $new)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <th>{{ $new->judul }}</th>
          <th>{{ $new->excerpt }}</th>
          <th>{{ \Carbon\Carbon::parse($new->created_at)->locale('id')->translatedFormat('d F Y') }}</th>
          <th><a href="/admin/berita/{{ $new->id }}">Lihat</a></th>
          <th>
            <button type="button" class="btn btn-error" onclick="showDeleteModal({{ $new->id }})">Hapus</button>
          </th>
        </tr>
        @endforeach
      </tbody>
      <tbody id="contentsearch" class="searchdata"></tbody>
    </table>
    <div class="flex justify-center mt-3">
      <a href="/admin/berita/buat" class="btn btn-neutral">Tambah Berita</a>
  </div>
</div>

<!-- Modal Konfirmasi -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Anda yakin ingin menghapus?</h2>
        <div class="flex justify-end">
            <button id="cancelButton" class="btn mr-3">Batalkan</button>
            <form id="deleteForm" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-error">Konfirmasi</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(newsId) {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/berita/${newsId}/hapus`;
        deleteModal.classList.remove('hidden');
    }

    document.getElementById('cancelButton').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.add('hidden');
    });

    window.addEventListener('click', function(event) {
        const deleteModal = document.getElementById('deleteModal');
        if (event.target == deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });

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
      url:'{{ URL::to('/admin/berita/search') }}',
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

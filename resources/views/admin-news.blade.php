@extends('layouts.admin')

@section('content')
<div class="flex justify-center">
    <a href="/admin/berita/buat" class="btn btn-primary">Buat Berita</a>
</div>
<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>No.</th>
          <th>Judul</th>
          <th>Isi</th>
          <th>detail</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($news as $new)
        <tr>
          <th>{{ $loop->iteration }}</th>
          <th>{{ $new->judul }}</th>
          <th>{{ $new->excerpt }}</th>
          <th>a</th>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>


@endsection
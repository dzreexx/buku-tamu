@extends('layouts.user')

@section('content')
    
<div class="overflow-x-auto">
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Riwayat Kunjungan</h1>
  </div>
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Tujuan</th>
          <th>Tanggal</th>
          <th>Masuk</th>
          <th>Keluar</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        @foreach ($guests as $guest)
            
        <tr>
          <th>{{ $loop->iteration }}</th>
          <td>{{ $guest->ket }}</td>
          <td>{{ $guest->created_at instanceof \Carbon\Carbon ? $guest->created_at->format('Y-m-d') : $guest->created_at }}</td>
          <td>
              @if ($guest->check_in_at instanceof \Carbon\Carbon)
                  {{ $guest->check_in_at->format('H:i') }}
              @else
                  {{ \Illuminate\Support\Str::after($guest->check_in_at, ' ') }}
              @endif
          </td>
          <td>
              @if ($guest->check_out_at instanceof \Carbon\Carbon)
                  {{ $guest->check_out_at->format('H:i') }}
              @else
                  {{ \Illuminate\Support\Str::after($guest->check_out_at, ' ') }}
              @endif
          </td>
      </tr>
      
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="flex justify-center items-center mt-10">
    <a href="/user/kunjungan" class="btn btn-neutral">Daftar Kunjungan</a>
    
  </div>

@endsection
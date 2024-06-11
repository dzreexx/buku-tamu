@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="search">
        <input id="search" name="search" type="text" placeholder="Cari Pengguna Berdasarkan apa saja" class="input input-bordered w-full mb-5" />
    </div>
</div>
<div class="overflow-x-auto">
  <table class="table table-xs">
    <thead>
      <tr>
        <th>No.</th> 
        <th>Nama</th> 
        <th>Keterangan</th> 
        <th>No Telpon</th> 
        <th>NIK</th> 
        <th>Tanggal</th> 
        <th>Masuk</th>
        <th>Keluar</th>
      </tr>
    </thead> 
    <tbody id="alldata">
        @foreach ($guests as $guest)    
        <tr>
          <th>{{ $loop->iteration }}</th> 
          <td>{{ $guest->nama }}</td> 
          <td>{{ $guest->ket }}</td> 
          <td>0{{ $guest->telp }}</td> 
          <td>{{ $guest->nik }}</td> 
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
      <tbody id="Content" class="searchData"></tbody>
  </table>
</div>

<script type="text/javascript">
    $('#search').on('keyup',function() 
    {
       $value=$(this).val();

       if($value)
       {
        $('#alldata').hide();
        $('.searchData').show();
       } else{
        $('#alldata').show();
        $('.searchData').hide();
       }

       $.ajax({
        type:'get',
        url:'{{URL::to('/admin/guests/search')}}',
        data:{'search':$value},

        success:function(data)
        {
            console.log(data);
            $('#Content').html(data);
        }
    });
    })
</script>

@endsection
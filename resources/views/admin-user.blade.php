@extends('layouts.admin')

@section('content')
<div class="content-satu mt-20 mb-20">
  <h1 class="text-2xl font-bold text-center">Permintaan Pengguna Baru</h1>
    @if($newUsers->isEmpty())
    <p class="text-center">Tidak ada Permintaan Pengguna Baru.</p>
    @else
  <div class="overflow-x-auto" id="main-content">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>
            <label>
              {{-- <input type="checkbox" class="checkbox" /> --}}
              No.
            </label>
          </th>
          <th>Nama</th>
          <th>NIK</th>
          <th>No Telpon</th>
          <th></th>
        </tr>
      </thead>
      @foreach ($newUsers as $nUser)
      <tbody>
        <tr>
          <th>
            <label>
              {{-- <input type="checkbox" class="checkbox" /> --}}
              {{ $loop->iteration }}
            </label>
          </th>
          <td>
            <div class="flex items-center gap-3">
              <div class="avatar">
                <div class="mask mask-squircle w-12 h-12">
                  <img src="{{ asset('storage/'.$nUser->img_path ) }}" alt="Avatar Tailwind CSS Component" />
                </div>
              </div>
              <div>
                <div class="font-bold">{{ $nUser->nama }}</div>
                <div class="text-sm opacity-50">{{ $nUser->email }}</div>
              </div>
            </div>
          </td>
          <td>
            {{ $nUser->nik }}
            <br/>
            {{-- <span class="badge badge-ghost badge-sm">no.telp{{ $nUser->telp }}</span> --}}
          </td>
          <td>{{ $nUser->telp }}</td>
          <th>
            <button 
              class="btn btn-ghost btn-xs" 
              data-id="{{ $nUser->id }}" 
              data-nama="{{ $nUser->nama }}" 
              data-nik="{{ $nUser->nik }}" 
              data-telp="{{ $nUser->telp }}" 
              data-email="{{ $nUser->email }}" 
              data-buat="{{ $nUser->created_at }}" 
              data-img="{{ asset('storage/'.$nUser->img_path ) }}" 
              onclick="openModal(this)">details</button>
          </th>
        </tr>
      </tbody>
      @endforeach
      <!-- foot -->
    </table>
</div>
@endif
</div>
<div class="content-dua ">
  <h1 class="text-2xl font-bold text-center mb-10">Daftar Pengguna</h1>
  <div class="container">
    <div class="search">
        <input id="search" name="search" type="text" placeholder="Cari Pengguna Berdasarkan apa saja" class="input input-bordered w-full mb-5" />
    </div>
  </div>
  <div class="overflow-x-auto" id="main-content">
    @if($users->isEmpty())
    <p class="text-center">User tidak di temukan.</p>
    @else

    
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th>
              <label>
                {{-- <input type="checkbox" class="checkbox" /> --}}
                No.
              </label>
            </th>
            <th>Nama</th>
            <th>NIK</th>
            <th>No Telpon</th>
            <th></th>
          </tr>
        </thead>
    <tbody id="alldata">
      @foreach ($users as $user)
      <tr>
        <th>
          <label>
            {{-- <input type="checkbox" class="checkbox" /> --}}
            {{ $loop->iteration }}
          </label>
        </th>
        <td>
          <div class="flex items-center gap-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img src="{{ asset('storage/'.$user->img_path ) }}" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">{{ $user->nama }}</div>
              <div class="text-sm opacity-50">{{ $user->email }}</div>
            </div>
          </div>
        </td>
        <td>
          {{ $user->nik }}
          <br/>
          {{-- <span class="badge badge-ghost badge-sm">no.telp{{ $user->telp }}</span> --}}
        </td>
        <td>0{{ $user->telp }}</td>
        <th>
          <button 
            class="btn btn-ghost btn-xs" 
            data-is-admin="{{ $user->is_admin }}" 
            data-id="{{ $user->id }}" 
            data-nama="{{ $user->nama }}" 
            data-nik="{{ $user->nik }}" 
            data-telp="0{{ $user->telp }}" 
            data-email="{{ $user->email }}" 
            data-buat="{{ $user->created_at }}" 
            data-img="{{ asset('storage/'.$user->img_path ) }}" 
            onclick="openModal(this)">details</button>
        </th>
      </tr>
      @endforeach
      @endif
    </tbody>
    <tbody id="contentsearch" class="searchdata"></tbody>
        <!-- foot -->
      </table>
  </div>
</div>

<!-- Modal structure -->
<!-- Modal structure -->
<div id="modal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
      <div class="bg-white p-6 rounded-lg shadow-lg md:w-1/3 w-full">
        <div class="flex justify-between items-center pb-3">
          <h3 class="text-lg font-medium">User Details</h3>
          <button class="text-gray-500 hover:text-gray-700" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
          <div class="flex flex-col items-center gap-4 mb-4">
            <div class="avatar">
              <div class="mask mask-squircle w-48 h-48">
                <img id="modal-user-img" src="" alt="User Avatar" />
              </div>
            </div>
            <div class="table">
              <ul class="list-none p-0">
                  <li class="flex justify-between border-b border-gray-300 py-2">
                      <strong>Name:</strong>
                      <span id="modal-user-name"></span>
                  </li>
                  <li class="flex justify-between border-b border-gray-300 py-2">
                      <strong>Email:</strong>
                      <span id="modal-user-email"></span>
                  </li>
                  <li class="flex justify-between border-b border-gray-300 py-2">
                      <strong>NIK:</strong>
                      <span id="modal-user-nik"></span>
                  </li>
                  <li class="flex justify-between border-b border-gray-300 py-2">
                      <strong>No Telpon:</strong>
                      <span id="modal-user-telp"></span>
                  </li>
                  <li class="flex justify-between border-b border-gray-300 py-2">
                      <strong>Tanggal daftar:</strong>
                      <span id="modal-user-buat"></span>
                  </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="flex justify-end pt-3">
          <button class="btn btn-neutral mx-3" onclick="closeModal()">Close</button>
          <form action="" method="POST" id="form-delete-user">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-error">Hapus Pengguna</button>
            </form>
          <form action="" class="mx-3" id="form-verify-user" method="POST">
              @csrf
              @method('PUT')
              {{-- <input type="hidden" id="id" name="id" value="{{ $nUser->id }}" > --}}
              <input type="hidden" id="is_admin" name="is_admin" value="0">
              <button type="submit" class="btn btn-info">Konfirmasi</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  

<!-- Tailwind CSS for blur effect -->
<style>
  .blur {
    filter: blur(5px);
  }
</style>

<script type="text/javascript">
  function openModal(button) {
    const userIsAdmin = button.getAttribute('data-is-admin');
    const userId = button.getAttribute('data-id');
    const userName = button.getAttribute('data-nama');
    const userNik = button.getAttribute('data-nik');
    const userTelp = button.getAttribute('data-telp');
    const userEmail = button.getAttribute('data-email');
    const userBuat = button.getAttribute('data-buat');
    const userImg = button.getAttribute('data-img');

    document.getElementById('modal-user-name').innerText = userName;
    document.getElementById('modal-user-nik').innerText = userNik;
    document.getElementById('modal-user-telp').innerText = userTelp;
    document.getElementById('modal-user-email').innerText = userEmail;
    document.getElementById('modal-user-buat').innerText = userBuat;
    document.getElementById('modal-user-img').src = userImg;

    const verifyUser = document.getElementById('form-verify-user');
    if (userIsAdmin == 0) {
    verifyUser.style.display = 'none'; // Jika user adalah admin, form konfirmasi disembunyikan
  } else {
    verifyUser.style.display = 'block'; // Jika user bukan admin, form konfirmasi ditampilkan
    verifyUser.action = '/admin/verify/'+userId;
  }
    
    // document.getElementById('form-verify-user').action = '/admin/verify/'+userId;
    document.getElementById('form-delete-user').action = '/admin/pengguna/'+userId;

    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('main-content').classList.add('blur');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    document.getElementById('main-content').classList.remove('blur');
  }

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
      url:'{{ URL::to('/admin/user/search') }}',
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

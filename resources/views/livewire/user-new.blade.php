<div wire:poll.10s>
    <h1 class="text-2xl font-bold text-center">Permintaan Pengguna Baru</h1>
    @if($newUsers->isEmpty())
    <p class="text-center">Tidak ada Permintaan Pengguna Baru.</p>
    @else
  
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="overflow-x-auto" id="main-content" >
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
                        @if ($nUser->img_path)
                        <img src="{{ asset('storage/'.$nUser->img_path ) }}" alt="Avatar Tailwind CSS Component" />
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                          </svg>                          
                        @endif
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

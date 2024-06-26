
    {{-- Success is as dangerous as failure. --}}
    <div class="overflow-x-auto text-center">
        <h1 class="text-2xl font-bold mb-4">Tamu Yang Berkunjung Hari ini</h1>
        @if($todays->isEmpty())
        <p class="text-center">Tidak ada kunjungan hari ini.</p>
        @else
        <table class="table">
          <!-- head -->
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Keterangan</th>
              <th>NIK</th>
              <th>No Telepon</th>
              <th>Masuk</th>
              <th>Keluar</th>
              {{-- <th>Foto</th> --}}
            </tr>
          </thead>
          @foreach ($todays as $today)
          <tbody>
            <tr>
              <th>{{ $loop->iteration }}</th>
              <td>{{ $today->nama }}</td>
              <td>{{ $today->ket }}</td>
              <td>0{{ $today->nik }}</td>
              <td>0{{ $today->telp }}</td>
              <td>
                  @if ($today->check_in_at instanceof \Carbon\Carbon)
                      {{ $today->check_in_at->format('H:i') }}
                  @else
                      {{ \Illuminate\Support\Str::after($today->check_in_at, ' ') }}
                  @endif
              </td>
              <td>
                  @if ($today->check_out_at instanceof \Carbon\Carbon)
                      {{ $today->check_out_at->format('H:i') }}
                  @else
                      {{ \Illuminate\Support\Str::after($today->check_out_at, ' ') }}
                  @endif
              </td>
              {{-- <td>
                <a href="{{ asset('storage/'.$guest->selfie_path) }}" data-baguettebox="gallery">
                  <img class="h-20" src="{{ asset('storage/'.$guest->selfie_path) }}" alt="">
                </a>
              </td> --}}
            </tr>
        </tbody>
        @endforeach
        </table>
        @endif
      </div>    


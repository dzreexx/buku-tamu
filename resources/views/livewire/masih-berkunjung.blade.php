
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="overflow-x-auto mb-10">
        <h1 class="text-2xl font-bold text-center">Tamu Yang Masih Berkunjung</h1>
        @if($guests->isEmpty())
        <p class="text-center">Tidak ada tamu yang masih berkunjung.</p>
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
              <th>Foto</th>
            </tr>
          </thead>
          @foreach ($guests as $guest)
          <tbody>
            <tr>
              <th>{{ $loop->iteration }}</th>
              <td>{{ $guest->nama }}</td>
              <td>{{ $guest->ket }}</td>
              <td>0{{ $guest->nik }}</td>
              <td>0{{ $guest->telp }}</td>
              <td>
                <a href="{{ asset('storage/'.$guest->selfie_path) }}" data-baguettebox="gallery">
                  <img class="h-20" src="{{ asset('storage/'.$guest->selfie_path) }}" alt="">
                </a>
              </td>
              <td>
                <form action="/admin/tamu/keluarkan/{{ $guest->id }}" method="POST">
                  @csrf
                <button type="submit" class="btn btn-error">
                  Keluar
                </button>
                </form>
              </td>
            </tr>
        </tbody>
        @endforeach
        </table>
        @endif
      </div>


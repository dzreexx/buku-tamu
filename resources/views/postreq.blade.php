<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('images/logotni.png') }}" type="image/x-png"/>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex justify-center items-center h-screen">
        <div class="card w-96 bg-base-100 shadow-xl">
            <figure><img src="{{ asset('images/logomabestni.png') }}" class="size-2/3" alt="TNI AL" /></figure>
            <div class="card-body flex items-center justify-center">
                <h2 class="card-title">TAMU</h2>
                <h2 class="card-title">MABESAL</h2>
                <h2 class="card-title">{{ $guest->ticket->number }}</h2>
                <p class="mt-4">Serahkan device ini ke petugas</p>
                <p class="mt-4">dan ambil kartu anda</p>
            </div>
        </div>
    </div>
    <div class="flex justify-center items-center h-screen">
        <div class="card w-96 bg-base-100 shadow-xl">
            <figure><img src="{{ asset('storage/' . $guest->selfie_path) }}" alt="Selfie" /></figure>
            <div class="card-body">
                <ul class="list-none p-0">
                    <li class="flex justify-between border-b border-gray-300 py-2">
                        <span class="font-bold">Nama:</span>
                        <span>{{ $guest->nama }}</span>
                    </li>
                    <li class="flex justify-between border-b border-gray-300 py-2">
                        <span class="font-bold">Telp:</span>
                        <span>0{{ $guest->telp }}</span>
                    </li>
                    <li class="flex justify-between border-b border-gray-300 py-2">
                        <span class="font-bold">Nik:</span>
                        <span>{{ $guest->nik }}</span>
                    </li>
                </ul>
                <p class="mt-4 font-bold">Keterangan: </p>
                <p>{{ $guest->ket }}</p>
                <div class="card-actions justify-between mt-4">
                    <form action="{{ route('guest.checkout', ['id' => $guest->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-error">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>
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
                <h2 class="card-title">{{ $user->ticket->number }}</h2>
                <p class="mt-4">Serahkan device ini ke petugas{{ $user->nama }}</p>
                <form action="{{ route('user.checkout', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    <div class="card-actions justify-end mt-4">
                        <button type="submit" class="btn btn-error">Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
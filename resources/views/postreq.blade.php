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
            <figure><img src="{{ asset('images/logotni.png') }}" class="" alt="TNI AL" /></figure>
            <div class="card-body">
                <h2 class="card-title">Kartu kamu P023</h2>
                <p>Serahkan device ini ke petugas{{ $nama }}</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-error">Keluar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }}</title>
        @vite('resources/css/app.css')
        <link rel="icon" href="{{ asset('images/logotni.png') }}" type="image/x-png"/>
        <link rel="stylesheet" href="resources/css/app.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    </head>
    <body">
      <div class="mx-auto w-1/4 h-screen flex items-center justify-center">
        <form class="px-8 pt-6 pb-8 mb-4" action="/" method="POST">
          @csrf
            <div class="flex items-center justify-center mb-4">
                <img class="mx-auto size-1/3" src="images/logotni.png" alt="">
              </div>
              <div class="flex items-center justify-center mb-4">
                <h1 class="font-bold text-xl font-inter">SELAMAT DATANG</h1>
              </div>
          <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2" for="nama">
                <input type="text" name="nama" id="nama" class="grow" placeholder="Nama" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>                
            </label>
          </div> 
          <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2" for="telp">
              {{-- <input type="number" name="telp" id="telp" class="grow" placeholder="+62" disabled/> --}}
                <input type="tel" name="telp" id="telp" class="grow" placeholder="Telp" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>                
            </label>
          </div> 
          <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2" for="nik">
                <input type="number" name="nik" id="nik" class="grow" placeholder="NIK" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>                
            </label>
          </div> 
          <div class="mb-3">
            <textarea placeholder="Keperluan" id="ket" name="ket" class="textarea textarea-bordered textarea-md w-full max-w-xl" ></textarea>
          </div> 
          <div class="flex items-center justify-center mb-4">
            <button class="btn btn-active" type="submit">Masuk</button>
          </div>
        </form>
    </div>
    </body>
    </html>
    
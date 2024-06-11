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
<body>
    @if(session()->has('loginError'))
    <div role="alert" class="alert alert-error w-full mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ session('loginError') }}</span>
      </div>
    @endif
    <div class="mx-auto w-1/4 h-screen flex items-center justify-center">
        <form class="px-8 pt-6 pb-8 mb-4" action="/login" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center mb-4">
            <img class="mx-auto size-1/3" src="images/logotni.png" alt="">
          </div>
          <div class="flex items-center justify-center mb-4">
            <h1 class="font-bold text-xl font-inter">LOGIN</h1>
          </div>
      <div class="mb-3">
        <label class="input input-bordered flex items-center gap-2 py-2 @error('telp') input-error @enderror" for="telp">
          {{-- <input type="number" name="telp" id="telp" class="grow" placeholder="+62" disabled/> --}}
          <input type="text" name="tlp" class="w-7" placeholder="+62" disabled/>
          <input type="text" name="telp" id="telp" class="grow" placeholder="Telp" autofocus required value="{{ old('telp') }}"/>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>                
        </label>
        @error('telp')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>      
      <div class="mb-3">
        <label class="input input-bordered flex items-center gap-2 py-2" for="password">
          <input type="password" name="password" id="password" class="grow" placeholder="Password" />
          <button type="button" onclick="togglePassword()" class="text-gray-500 focus:outline-none">
            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
          </button>
        </label>
      </div>
      <div class="flex items-center justify-center mb-4">
        <button class="btn btn-active" type="submit">Masuk</button>
      </div>
      <p class="mt-10 text-center text-sm text-gray-500">
        Belum Mendaftar?
        <a href="/daftar" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Daftar</a>
      </p>
      <p class="mt-10 text-center text-sm text-gray-500">
        <a href="/forgot-password" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Lupa Password</a>
      </p>
    </form>
  </div>
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eye-icon');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />';
      } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />';
      }
    }
  </script>
</body>
</html>

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
      <div class="mx-auto w-1/4  flex items-center justify-center">
        <form class="px-8 pt-6 pb-8 mb-4" action="/daftar" method="POST" id="uploadForm" enctype="multipart/form-data">
          @csrf
            <div class="flex items-center justify-center mb-4">
                <img class="mx-auto size-1/3" src="images/logotni.png" alt="">
              </div>
              <div class="flex items-center justify-center mb-4">
                <h1 class="font-bold text-xl font-inter">Daftar Akun</h1>
              </div>
          <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2 @error('nama') input-error @enderror" for="nama">
                <input type="text" name="nama" id="nama" class="grow" placeholder="Nama" autofocus required value="{{ old('nama') }}" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>                
            </label>
            @error('nama')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div> 
          <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2 @error('email') input-error @enderror" for="email">
                <input type="email" name="email" id="email" class="grow" placeholder="email" required value="{{ old('email') }}"/>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                </svg>
            </label>
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div> 
          <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2 @error('telp') input-error @enderror" for="telp">
              {{-- <input type="number" name="telp" id="telp" class="grow" placeholder="+62" disabled/> --}}
              <input type="text" name="tlp" class="w-7" placeholder="+62" disabled/>
                <input type="number" name="telp" id="telp" class="grow" placeholder="Telp" required value="{{ old('telp') }}"/>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>                
            </label>
            @error('telp')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div> 
          <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2 @error('nik') input-error @enderror" for="nik">
                <input type="number" name="nik" id="nik" class="grow" placeholder="NIK" required value="{{ old('nik') }}"/>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>                
            </label>
            @error('nik')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div> 
          <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2 @error('password') input-error @enderror" for="password">
                <input type="password" name="password" id="password" class="grow" placeholder="password" required value="{{ old('passwords') }}"/>
                <button type="button" onclick="togglePassword()" class="text-gray-500 focus:outline-none">
                  <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>                
              </label>
              @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div> 
          {{-- <div class="mb-3">
            <label class="input input-bordered flex items-center gap-2 py-2" for="confirm">
                <input type="password" name="confirm" id="confirm" class="grow" placeholder="Konfirmasi Password" />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>                
            </label>
          </div>  --}}
          <div class="mb-3">
            <label class="form-control w-full max-w-xl @error('img_profile') input-error @enderror">
                <div class="label">
                    <span class="label-text">Ambil Foto selfie diri anda Sendiri</span>
                </div>
                <input type="file" name="img_profile" id="img_profile" accept="image/*" capture="user" class="file-input file-input-bordered w-full max-w-xl" onchange="previewImage(event)" required/>
            </label>
            @error('img_profile')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div id="preview-container" class="mb-3" style="display: none;">
            <img id="preview-image" src="#" alt="Preview" class="w-full max-w-xl" />
        </div> 
        <div class="mb-3">
          {!! NoCaptcha::renderJs('id') !!}
          {!! NoCaptcha::display() !!}
          @error('g-recaptcha-response')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>   
          <div class="flex items-center justify-center mb-4">
            <button class="btn btn-active" type="submit">Daftar</button>
          </div>
          <p class="mt-10 text-center text-sm text-gray-500">
            Sudah punya akun?
            <a href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login</a>
          </p>
        </form>
    </div>

    <script>
      function previewImage(event) {
          const previewContainer = document.getElementById('preview-container');
          const previewImage = document.getElementById('preview-image');
          const file = event.target.files[0];
          const reader = new FileReader();
  
          reader.onload = function() {
              previewImage.src = reader.result;
              previewContainer.style.display = 'block';
          }
  
          if (file) {
              reader.readAsDataURL(file);
          }
      }

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
    
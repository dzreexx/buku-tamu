<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('images/logotni.png') }}" type="image/x-png"/>
</head>
<body>
    
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<div class="min-h-full">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img class="h-8 w-8" src="{{ asset('images/logotni.png') }}" alt="Your Company">
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="/" class="{{ $page === 'Beranda' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $page === 'dashboard' ? 'page' : '' }}">Beranda</a>
                <a href="/tentang" class="{{ $page === 'Tentang' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $page === 'dashboard' ? 'page' : '' }}">Tentang</a>
                <a href="/informasi" class="{{ $page === 'Informasi' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $page === 'dashboard' ? 'page' : '' }}">Informasi</a>
                @if(Auth::user() && auth()->user()->is_admin === 0)
                <a href="/kunjungan" class="{{ $page === 'Kunjungan' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Kunjungan</a>
                @elseif(Auth::user() && auth()->user()->is_admin === 1)
                @elseif(Auth::user() && auth()->user()->is_admin == '')
                @else
                <a href="/kunjungan-langsung" class="{{ $page === 'Kunjungan' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Kunjungan</a>
                @endif
              </div>
            </div>
          </div>
          <div class="hidden md:block">
                @if(Auth::user() && auth()->user()->is_admin === 0)
                <div>
                  {{-- <button id="foto-profile" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true"> --}}
                    <button onclick="toggleMenu()" id="foto-profile" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Buka menu pengguna</span>
                    <img class="h-8 w-8 rounded-full" src="{{ asset('storage/'. auth()->user()->img_path) }}" alt="">
                    {{-- <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>                                          --}}
                  </button>
                </div>
                @elseif(Auth::user() && auth()->user()->is_admin === 1)
                <div>
                    <button onclick="toggleMenuAdmin()" id="foto-profile" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Buka menu Admin</span>
                    <img class="h-8 w-8 rounded-full" src="{{ asset('storage/'. auth()->user()->img_path) }}" alt="">
                  </button>
                </div>
                @elseif(Auth::user() && auth()->user()->is_admin == '')
                <div>
                  <form action="/logout" method="post">
                    @csrf
                  <button class="btn btn-neutral">Keluar</button>
                  </form>
                </div>
                @else
                <div>
                  <a href="/login" class="btn btn-primary">Masuk</a>
                </div>
                @endif
                <div id="menu-profile" class="hidden absolute z-10 mt-2 w-48 left-auto right-0 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                  <a href="/user/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Profil</a>
                  <form action="/logout" method="post">
                    @csrf
                    <a href="" class="block px-4 py-2 text-sm text-gray-700">
                    <button type="submit" class="w-full text-left">
                          Keluar
                        </button>
                      </a>
                  </form>
                </div>
                <div id="menu-profile-admin" class="hidden absolute z-10 mt-2 w-48 left-auto right-0 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                  <a href="/admin" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Halaman Admin</a>
                  <form action="/logout" method="post">
                    @csrf
                    <a href="" class="block px-4 py-2 text-sm text-gray-700">
                    <button type="submit" class="w-full text-left">
                          Keluar
                        </button>
                      </a>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
              <button type="button" onclick="toggleMobileMenu()" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                <span class="absolute -inset-0.5"></span>
              <span class="sr-only">Open main menu</span>
              <!-- Menu open: "hidden", Menu closed: "block" -->
              <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
              <!-- Menu open: "block", Menu closed: "hidden" -->
              <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>
  
      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="md:hidden hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <a href="/" class="{{ $page === 'Beranda' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Beranda</a>
          <a href="/tentang" class="{{ $page === 'Tentang' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Tentang</a>
          <a href="/informasi" class="{{ $page === 'Informasi' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Informasi</a>
          @if(Auth::user() && auth()->user()->is_admin === 0)
          <a href="/kunjungan" class="{{ $page === 'Kunjungan' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Kunjungan</a>
          @elseif(Auth::user() && auth()->user()->is_admin === 1)
          @elseif(Auth::user() && auth()->user()->is_admin == '')
          @else
          <a href="/kunjungan-langsung" class="{{ $page === 'Kunjungan' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">Kunjungan</a>
          @endif
        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
          <div class="flex items-center px-5">
          </div>
          @if(Auth::user() && auth()->user()->is_admin === 0)
          <div class="mt-3 space-y-1 px-2">
            <a href="/user/profile" class="block rounded-md px-3 py-2 text-base font-medium {{ $page === 'Profil' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }}">profil</a>
            <form action="/logout" method="post">
                @csrf
                <a href="" class="block rounded-md px-3 py-2 text-base font-medium {{ $page === 'logout' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }}">
                    <button class="w-full flex justify-start" type="submit">Keluar</button>
                </a>
              </form>
            </div>
          @elseif(Auth::user() && auth()->user()->is_admin === 1)
          <div class="mt-3 space-y-1 px-2">
            <a href="/admin" class="block rounded-md px-3 py-2 text-base font-medium {{ $page === 'Profil' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }}">Halaman Admin</a>
            <form action="/logout" method="post">
                @csrf
                <a href="" class="block rounded-md px-3 py-2 text-base font-medium {{ $page === 'logout' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }}">
                    <button class="w-full flex justify-start" type="submit">Keluar</button>
                </a>
              </form>
            </div>
          @elseif(Auth::user() && auth()->user()->is_admin == '')
          <div class="mt-3 space-y-1 px-2">
              <form action="/logout" method="post">
                @csrf
                <a href="" class="block rounded-md px-3 py-2 text-base font-medium {{ $page === 'logout' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }}">
                    <button class="w-full flex justify-start" type="submit">Keluar</button>
                </a>
              </form>
            </div>
            @else
            <a href="/login" class="block rounded-md px-3 py-2 text-base font-medium {{ $page === 'Profil' ? 'bg-gray-900 text-white' : 'text-black-300 hover:bg-gray-700 hover:text-white' }}">Masuk</a>
            @endif
          </div>
      </div>
      @if(!empty($thumbnail))
      <div class="hero min-h-full h-80 bg-cover bg-center" style="background-image: url('{{ $thumbnail }}');">
        <div class="hero-overlay bg-gradient-to-b from-black/60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">{{ $judul }}</h1>
                <p class="mb-5">{{ $desc }}</p>
            </div>
        </div>
    </div>
    @endif
    </nav>
  
    {{-- <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $page }}</h1>
      </div>
    </header> --}}
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            @yield('content')
      </div>
    </main>
  </div>
@if (!empty($judul))
  <tr>
    <td valign="middle" height="200">
        <!--
        <img src="https://www.tnial.mil.id/images/footer.png" width="100%" />-->
        <div align="center" class="pt-5" style="font-size:13px;background-color:#E9ECF3;">	
            
            <div class="flex justify-center">
                
                    <hr class="thin bg-grayLighter"><br>
                    <a href="http://www.tni.mil.id" target="_blank">
                    <img alt="MABES TNI" src="https://www.tnial.mil.id/images/logo_tni.png" style="height:40px; width:40px">
                    </a>&nbsp;    
                    <a href="http://www.tnial.mil.id" target="_blank">
                    <img alt="TNI AL" src="https://www.tnial.mil.id/images/logo_tnial.png" style="height:42px; width:40px">
                    </a>&nbsp;                                                               
                    <a href="http://www.tniau.mil.id" target="_blank">
                    <img alt="TNI AU" src="https://www.tnial.mil.id/images/logo_tniau.png" style="height:40px; width:40px">
                    </a>&nbsp;                    
                    <a href="http://www.tniad.mil.id" target="_blank">
                    <img alt="TNI AD" src="https://www.tnial.mil.id/images/logo_tniad.png" style="height:40px; width:35px">
                    </a>  <br>
            </div><br>
                
            <strong>Copyright © Tentara Nasional Indonesia Angkatan Laut</strong>
            <br><br>Komplek Militer Cilangkap, Cilangkap, Cipayung, Kota Jakarta Timur<br> Daerah Khusus Ibukota Jakarta 13870<br><br>Kontak Kami:<br> Email. dispenal@tnial.mil.id <br>Telp. (021) 8723308<br>Hp. +6281382556085<br> Fax. (021) 8710628<br><br><br>				</div>
    </td>
</tr>
@endif

  <script>
    function toggleMenu() {
        var menu = document.getElementById("menu-profile");
        menu.classList.toggle("hidden");
        menu.classList.toggle("block");
    }

    function toggleMenuAdmin() {
        var menu = document.getElementById("menu-profile-admin");
        menu.classList.toggle("hidden");
        menu.classList.toggle("block");
    }

    function toggleMobileMenu() {
        var mobileMenu = document.getElementById("mobile-menu");
        mobileMenu.classList.toggle("hidden");
    }
</script>

</body>
</html>
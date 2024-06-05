{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body>
    Tampilan Desktop 
    <div class="drawer lg:drawer-open hidden lg:block">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col items-center justify-center">
          <!-- Page content here -->
          <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>
        
        </div> 
        <div class="drawer-side">
          <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label> 
          <ul class="menu p-4 w-72 min-h-full bg-base-200 text-base-content ">
            <!-- Sidebar content here -->
            <img class="mx-auto h-20 w-auto mb-5" src="{{ asset('images/logotni.png') }}" alt="Your Company">
            <li class="{{ $page === 'Daftar Kunjungan' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 my-2 py-2  text-sm font-medium"><a>Sidebar Item 1</a></li>
            <li class="{{ $page === 'hello' ? 'bg-gray-900 text-white' : 'text-gray-800 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 my-2 py-2 text-sm font-medium"><a>Sidebar Item 2</a></li>
          </ul>
        </div>
      </div>
       Tampilan Mobile 

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.js" 
    integrity="sha512-qiVW4rNFHFQm0jHli5vkdEwP4GPSzCSp85J7JRHdgzuuaTg31tTMC8+AHdEC5cmyMFDByX639todnt6cxEc1lQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.49.1/apexcharts.min.css" 
    integrity="sha512-LJwWs3xMbOQNFpWVlpR0Dv3ND8TQgLzvBJsfjMcPKax6VJQ8p9WnQvB5J5Lb9/0D31cbnNsh9x5Lz6+mzxgw1g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script> --}}
  <link rel="stylesheet" href="/css/trix.css">
  
  <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
      display:none;
    }
  </style>
</head>
<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col lg:flex-row">
            <!-- Page content here -->
            <label for="my-drawer" class="btn btn-ghost w-1/6 flex justify-start drawer-button lg:hidden ml-2">
                <!-- Heroicons Hamburger Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </label>
            <div class="content p-4 lg:w-full">
                <!-- Isi konten di sini -->
                <h1 class="text-2xl font-bold mb-4">{{ $page }}</h1>
                <div class="overflow-x-auto w-full">
                    @yield('content')
                </div>
            </div>
        </div> 
        <div class="drawer-side" style="z-index: 999999;">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
                <!-- Sidebar content here -->
                <img class="mx-auto h-20 w-auto mb-5" src="{{ asset('images/logotni.png') }}" alt="Your Company">
                <li class="{{ $page === 'Kunjungan' ? 'bg-gray-900 text-white' : 'text-gray-800 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 my-2 py-2  text-sm font-medium"><a href="/admin">Kunjungan</a></li>
                <li class="{{ $page === 'Tamu' ? 'bg-gray-900 text-white' : 'text-gray-800 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 my-2 py-2  text-sm font-medium"><a href="/admin/tamu">Tamu</a></li>
                <li class="{{ $page === 'Kelola Pengguna' ? 'bg-gray-900 text-white' : 'text-gray-800 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 my-2 py-2 text-sm font-medium"><a href="/admin/pengguna">Pengguna</a></li>
                <li class="{{ in_array($page, ['Kelola Berita', 'Buat Berita'])  ? 'bg-gray-900 text-white' : 'text-gray-800 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 my-2 py-2 text-sm font-medium"><a href="/admin/berita">Berita</a></li>
                <li class="{{ in_array($page, ['Informasi', 'Buat Berita'])  ? 'bg-gray-900 text-white' : 'text-gray-800 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 my-2 py-2 text-sm font-medium"><a href="/admin/informasi">Informasi</a></li>
                <hr class="border-t border-gray-300 my-1">
                <form action="/logout" method="post">
                  @csrf
                <button type="submit">
                  <li class="{{ $page === 'hello' ? 'bg-gray-900 text-white' : 'text-gray-800 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 my-2 py-2 text-sm font-medium"><a>LogOut</a></li>
                </button>
                </form>
            </ul>
        </div>
    </div>
</body>
</html>

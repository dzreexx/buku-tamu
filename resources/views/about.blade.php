@extends('layouts.user')

@section('content')

{{-- <div class="artboard artboard-horizontal phone-6" style="background-image: url(images/disinfolahtal.png)">
    <img src="images/disinfolahtal.png" alt="">
  </div> --}}

  {{-- <header class=" text-white p-4">
    <div class="container mx-auto">
        <img src="images/disinfolahtal.png" alt="">
        <h1 class="text-3xl font-bold">TNI AL</h1>
        <p class="text-lg">Tentara Nasional Indonesia Angkatan Laut</p>
    </div>
</header> --}}

<main class="container mx-auto p-4">
    <section id="sejarah" class="my-8">
        <h2 class="text-2xl font-bold mb-4">Deskripsi</h2>
        <p>Dinas  Informasi  dan  penggolahan  data  Angkatan  Laut  (Disinfolahtal)  merupakan  sebuah  lembaga  di  TNI Angkatan  yang  bergerak  dalam  bidang  Informasi  dan  pengolahan  data  (Infolahta)  yang  bertugas  untuk merencanakan,   menganalisa,   mendesain   dan   mengimplementasikan   sistem   informasi   di   lingkungan   TNI Angkatan  Laut.  Lembaga  ini  merupakan  pembina  profesi  dalam  bidang  Infomasi  dan  pengolahan  data.
        </p>
    </section>

    <section id="misi" class="my-8">
        <h2 class="text-2xl font-bold mb-4">Misi</h2>
        <ul class="list-disc pl-5">
            <li><b>Mengembangkan Sistem Informasi yang Handal:</b> Merencanakan, menganalisa, mendesain, dan mengimplementasikan sistem informasi yang efektif dan efisien untuk mendukung operasional TNI Angkatan Laut.</li>
            <li><b>Meningkatkan Keamanan Data:</b> Menjamin keamanan dan kerahasiaan data melalui penerapan teknologi informasi terbaru dan kebijakan keamanan siber yang ketat.</li>
            <li><b>Menyediakan Layanan Informasi yang Akurat dan Tepat Waktu:</b> Menyediakan layanan informasi yang akurat, relevan, dan tepat waktu untuk mendukung pengambilan keputusan di lingkungan TNI Angkatan Laut.</li>
            <li><b>Melakukan Pembinaan dan Pengembangan Profesionalisme:</b> Membina dan mengembangkan profesionalisme personel di bidang informasi dan pengolahan data melalui pelatihan, sertifikasi, dan pengembangan karir.</li>
            <li><b>Meningkatkan Efisiensi Operasional:</b> Mengoptimalkan penggunaan teknologi informasi untuk meningkatkan efisiensi dan efektivitas operasional di seluruh unit TNI Angkatan Laut.</li>
            <li><b>Memfasilitasi Integrasi Sistem Informasi:</b> Memastikan integrasi dan interoperabilitas sistem informasi di lingkungan TNI Angkatan Laut untuk mendukung koordinasi dan sinergi antar unit.</li>
            <li><b>Melakukan Monitoring dan Evaluasi:</b> Melakukan monitoring dan evaluasi secara berkala terhadap sistem informasi dan pengolahan data untuk memastikan kualitas dan kinerja yang optimal.</li>
            <li><b>Inovasi dan Penelitian:</b> Mendorong inovasi dan penelitian di bidang teknologi informasi dan pengolahan data untuk terus memperbarui dan meningkatkan kapabilitas sistem informasi TNI Angkatan Laut.</li>
        </ul>
    </section>

    <section id="galeri" class="my-8 flex justify-center">
        {{-- <h2 class="text-2xl font-bold mb-4">Galeri</h2> --}}
        {{-- <div class="aspect-w-16 aspect-h-9">
            <iframe class="w-full h-full" src="https://www.youtube.com/embed/Os5eOG27Wx8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div> --}}
        <div class="artboard artboard-horizontal phone-4">    
            <iframe class="w-full h-full" src="https://www.youtube.com/embed/Os5eOG27Wx8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </section>
</main>

{{-- <footer class="bg-blue-900 text-white p-4 mt-8">
    <div class="container mx-auto text-center">
        <p>&copy; 2024 TNI AL. All rights reserved.</p>
    </div>
</footer> --}}

@endsection

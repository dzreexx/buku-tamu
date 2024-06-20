@extends('layouts.admin')

@section('content')
<div class="flex justify-start items-center mb-10">
  <livewire:chart-bulan/>
</div>
<livewire:chart-tahun/>
</div>
  <livewire:masih-berkunjung/>
  <livewire:sudah-keluar/>
@endsection

<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Guest;
use Livewire\Component;

class ChartTahun extends Component
{
    public function render()
    {
        $guest = Guest::where('check_out_at', null)->get();
        
        $visitors = Guest::selectRaw('YEAR(check_in_at) as year, MONTH(check_in_at) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        $visitorsLogin = Guest::whereNotNull('user_id')
        ->selectRaw('YEAR(check_in_at) as year, MONTH(check_in_at) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    $visitorsNotLogin = Guest::whereNull('user_id')
        ->selectRaw('YEAR(check_in_at) as year, MONTH(check_in_at) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        $labels = $visitors->map(function ($item) {
            // Mengonversi nomor bulan menjadi nama bulan
            $monthName = Carbon::create()->month($item->month)->format('F');
            return $monthName . ' ' . $item->year;
        })->toArray();

        $labelsYear = $visitors->map(function ($item) {
            // Mengonversi nomor bulan menjadi nama bulan
            // $monthName = Carbon::create()->month($item->month)->format('F');
            return $item->year;
        })->toArray();

        $dataNotLogin = $visitorsNotLogin->pluck('count')->toArray();
        $dataLogin = $visitorsLogin->pluck('count')->toArray();
        $data = $visitors->pluck('count')->toArray();

        return view('livewire.chart-tahun',compact('labels', 'data', 'dataLogin', 'dataNotLogin', 'labelsYear'));
    }
}

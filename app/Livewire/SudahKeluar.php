<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Guest;
use Livewire\Component;

class SudahKeluar extends Component
{
    public function render()
    {
        $today = Carbon::today('Asia/Jakarta');
        $today = Guest::whereDate('check_in_at', $today)->get();
        
        return view('livewire.sudah-keluar',[
            'todays' => $today,
        ]);
    }
}

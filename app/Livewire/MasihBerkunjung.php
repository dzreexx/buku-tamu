<?php

namespace App\Livewire;

use App\Models\Guest;
use Livewire\Component;

class MasihBerkunjung extends Component
{
    public function render()
    {
        $guest = Guest::where('check_out_at', null)->get();
        return view('livewire.masih-berkunjung',[
            'guests' => $guest,
        ]);
    }
}

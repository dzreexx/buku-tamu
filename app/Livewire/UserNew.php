<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;


class UserNew extends Component
{
    public function render()
    {
        // $newUsers = Cache::remember('users', 60, function () {
        //     return User::where('is_admin', null)->latest()->get();
        // });
         
        // return view('livewire.user-new',[
        //     'newUsers' => $newUsers,
        // ]);
        $newUsers = User::where('is_admin', null)->latest()->get();
        return view('livewire.user-new',[
            'newUsers' => $newUsers,
        ]);
    }
}

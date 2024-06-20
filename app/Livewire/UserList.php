<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserList extends Component
{
    public $count = 0;
 
    public function increment()
    {
        $this->count++;
    }
    public function render()
    {
        $users = User::latest()->get()->all();
        return view('livewire.user-list',[
            'users' => $users,
        ]);
    }
}

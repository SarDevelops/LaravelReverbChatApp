<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ChatList extends Component
{
    public $users;

    public function mount()
    {
        // Fetch users except the authenticated user
        $this->users = User::where('id', '!=', auth()->id())->get();

    }

    public function render()
    {
        return view('livewire.chat-list', ['users' => $this->users]);
    }
}
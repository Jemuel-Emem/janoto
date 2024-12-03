<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $name;
    public $isModalOpen = false;
    public $email;

    public function mount()
    {
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $user = Auth::user();

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function updateProfile()
    {


        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);


        $user = Auth::user();

        if ($user) {
            // Update user details
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            $this->isModalOpen = false;
        } else {
            // Handle case where user is not found
            session()->flash('error', 'User not found.');
        }
    }

    public function render()
    {
        return view('livewire.user.profile');
    }
}

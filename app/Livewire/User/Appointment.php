<?php

namespace App\Livewire\User;

use App\Models\Appointment as ap;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Appointment extends Component
{
    public $appointments;

    public function mount()
    {

        $this->appointments = ap::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.user.appointment', ['appointments' => $this->appointments]);
    }
}

<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\appointment as Appointment;

class PatientHistory extends Component
{
    public $appointments = [];

    public function mount()
    {

        $this->appointments = Appointment::where('status', 'confirmed')
            ->with(['user', 'service'])
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.patient-history', [
            'appointments' => $this->appointments,
        ]);
    }
}

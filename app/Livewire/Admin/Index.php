<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\Appointment;
use App\Models\Schedule;
use Livewire\Component;

class Index extends Component
{
    public $serviceCount;
    public $appointmentCount;
    public $scheduleCount;

    public function mount()
    {

        $this->serviceCount = Service::count();
        $this->appointmentCount = Appointment::count();
        $this->scheduleCount = Appointment::where('status', 'confirmed')->count();
    }

    public function render()
    {
        return view('livewire.admin.index');
    }
}

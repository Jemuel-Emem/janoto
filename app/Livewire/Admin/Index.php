<?php
namespace App\Livewire\Admin;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\Appointment;
use Livewire\Component;

class Index extends Component
{
    public $serviceCount;
    public $appointmentCount;
    public $scheduleCount;
    public $latestAppointments;

    public function mount()
    {

        $this->serviceCount = Service::count();
        $this->appointmentCount = Appointment::count();
        $this->scheduleCount = Appointment::where('status', 'confirmed')->count();


        $this->latestAppointments = Appointment::whereDate('appointment_date', Carbon::today())->get();
    }

    public function render()
    {
        return view('livewire.admin.index');
    }
}

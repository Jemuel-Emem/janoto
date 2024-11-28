<?php
namespace App\Livewire\Admin;

use App\Models\Appointment as ap;
use Livewire\Component;

class Appointment extends Component
{

    public function render()
    {
        $appointments = ap::with('user', 'service')->get();

        return view('livewire.admin.appointment', compact('appointments'));
    }


    public function confirmAppointment($id)
    {
        $appointment = ap::find($id);
        $appointment->status = 'confirmed';
        $appointment->save();

        session()->flash('message', 'Appointment confirmed!');
    }


    public function cancelAppointment($id)
    {
        $appointment = ap::find($id);
        $appointment->status = 'canceled';
        $appointment->save();

        session()->flash('message', 'Appointment canceled!');
    }
}


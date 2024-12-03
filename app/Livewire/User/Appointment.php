<?php
namespace App\Livewire\User;

use App\Models\appointment as app;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Appointment extends Component
{
    public $appointments;

    public function mount()
    {

        $this->appointments = app::where('user_id', Auth::id())->get();
    }

    public function cancelAppointment($appointmentId)
    {
        $appointment = app::find($appointmentId);

        if ($appointment && $appointment->status === 'pending') {
            $appointment->update(['status' => 'cancelled']);
            session()->flash('success', 'Appointment has been cancelled.');
        } else {
            session()->flash('error', 'Appointment cannot be cancelled.');
        }


        $this->appointments = app::where('user_id', Auth::id())->get();
    }



    public function render()
    {
        return view('livewire.user.appointment', ['appointments' => $this->appointments]);
    }
}

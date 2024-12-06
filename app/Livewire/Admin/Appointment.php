<?php
namespace App\Livewire\Admin;

use App\Models\Appointment as ap;
use Livewire\Component;
use Carbon\Carbon;

class Appointment extends Component
{
    public $appointments;
    public $start_date;
    public $end_date;
    public $add_note_modal = false;
    public $note;
    public $selectedAppointmentId;

    public function mount()
    {

        $this->appointments = ap::with('user', 'service')->get() ?: collect();
    }

    public function render()
    {
        return view('livewire.admin.appointment');
    }


    public function updatedStartDate()
    {
        $this->filterAppointments();
    }

    public function updatedEndDate()
    {
        $this->filterAppointments();
    }

    public function filterAppointments()
    {
        $appointmentsQuery = ap::with('user', 'service');


        if ($this->start_date) {
            $appointmentsQuery->whereDate('appointment_date', '>=', Carbon::parse($this->start_date));
        }


        if ($this->end_date) {
            $appointmentsQuery->whereDate('appointment_date', '<=', Carbon::parse($this->end_date));
        }


        $this->appointments = $appointmentsQuery->get();
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
        $this->selectedAppointmentId = $id;
        $this->add_note_modal = true;
    }

    public function submitNote()
    {
        $appointment = ap::find($this->selectedAppointmentId);

        if ($appointment) {
            $appointment->status = 'cancelled';
            $appointment->note = $this->note;
            $appointment->save();
        }

        $this->closeModal();
        session()->flash('message', 'Appointment canceled with note!');


        $this->appointments = ap::with('user', 'service')->get();
    }

    public function closeModal()
    {
        $this->add_note_modal = false;
        $this->note = '';
    }
}

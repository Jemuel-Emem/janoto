<?php

namespace App\Livewire\User;
use App\Models\appointment;
use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;

class Services extends Component
{
    use WithPagination;
    public $appointmentDate = '';
    public $appointmentTime = '';
    public $search = '';
    public $selectedService = null;
    public $showModal = false;

    public function render()
    {
        $services = Service::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(9);

        return view('livewire.user.services', compact('services'));
    }

    public function viewService($id)
    {
        $this->selectedService = Service::findOrFail($id);
        $this->showModal = true;
    }

    public function submitAppointment()
    {

        $this->validate([
            'appointmentDate' => 'required|date|after_or_equal:today',
            'appointmentTime' => 'required|date_format:H:i',
        ]);


        Appointment::create([
            'user_id' => auth()->id(),
            'service_id' => $this->selectedService->id,
            'appointment_date' => $this->appointmentDate,
            'appointment_time' => $this->appointmentTime,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Your appointment has been successfully submitted.');
        $this->closeModal();
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedService = null;
    }

    public function searchServices(){

    }
}


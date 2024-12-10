<?php

namespace App\Livewire\User;

use App\Models\Appointment;
use Livewire\Component;
use App\Models\Service;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class Services extends Component
{
    use Actions;
    use WithPagination;
    public $showCalendarModal = false;
    public $appointmentDate = '';
    public $appointmentTime = '';
    public $search = '';
    public $selectedService = null;
    public $showModal = false;
    public $termsAccepted = false;
    public $errorMessage = '';
    public $appointments = [];

    public function render()
    {
        // Fetch services
        $services = Service::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->paginate(9);

        // Fetch confirmed appointments for the logged-in user
        $this->appointments = Appointment::where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->with(['user', 'service'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'user' => ['name' => $appointment->user->name],
                    'service' => ['name' => $appointment->service->name],
                    'appointment_date' => $appointment->appointment_date,
                    'appointment_time' => $appointment->appointment_time,
                ];
            })
            ->toArray();

        return view('livewire.user.services', compact('services'));
    }

    // Other functions like viewService(), submitAppointment() remain the same

    // public function render()
    // {
    //     $services = Service::where('name', 'like', '%' . $this->search . '%')
    //         ->orWhere('description', 'like', '%' . $this->search . '%')
    //         ->paginate(9);

    //     return view('livewire.user.services', compact('services'));
    // }

    public function viewService($id)
    {
        $this->selectedService = Service::findOrFail($id);
        $this->showModal = true;
    }

    // public function submitAppointment()
    // {
    //     // Validate appointment date and time
    //     $this->validate([
    //         'appointmentDate' => 'required|date|after_or_equal:today',
    //         'appointmentTime' => 'required|date_format:H:i',
    //         'termsAccepted' => 'accepted', // Ensure terms are accepted
    //     ]);

    //     // Create the appointment
    //     Appointment::create([
    //         'user_id' => auth()->id(),
    //         'service_id' => $this->selectedService->id,
    //         'appointment_date' => $this->appointmentDate,
    //         'appointment_time' => $this->appointmentTime,
    //         'status' => 'pending',
    //     ]);

    //     session()->flash('success', 'Your appointment has been successfully submitted.');
    //     $this->closeModal();
    // }
    // public function submitAppointment()
    // {
    //     // Validate appointment date and time
    //     $this->validate([
    //         'appointmentDate' => 'required|date|after_or_equal:today',
    //         'appointmentTime' => [
    //             'required',
    //             'date_format:H:i',
    //             function ($attribute, $value, $fail) {
    //                 $startTime = strtotime('08:00');
    //                 $endTime = strtotime('17:00');
    //                 $appointmentTime = strtotime($value);

    //                 if ($appointmentTime < $startTime || $appointmentTime > $endTime) {
    //                     $fail('The appointment time must be within clinic hours (8:00 AM to 5:00 PM).');
    //                 }
    //             }
    //         ],
    //         'termsAccepted' => 'accepted', // Ensure terms are accepted
    //     ]);

    //     // Create the appointment
    //     Appointment::create([
    //         'user_id' => auth()->id(),
    //         'service_id' => $this->selectedService->id,
    //         'appointment_date' => $this->appointmentDate,
    //         'appointment_time' => $this->appointmentTime,
    //         'status' => 'pending',
    //     ]);

    //     session()->flash('success', 'Your appointment has been successfully submitted.');
    //     $this->closeModal();
    // }

    public function submitAppointment()
{
    // Validate appointment date and time
    $this->validate([
        'appointmentDate' => 'required|date|after_or_equal:today',
        'appointmentTime' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) {
                $startTime = strtotime('08:00');
                $endTime = strtotime('17:00');
                $appointmentTime = strtotime($value);

                if ($appointmentTime < $startTime || $appointmentTime > $endTime) {
                    $fail('The appointment time must be within clinic hours (8:00 AM to 5:00 PM).');
                }
            }
        ],
        'termsAccepted' => 'accepted',
    ]);


    $existingAppointment = Appointment::where('user_id', auth()->id())
        ->where('appointment_date', $this->appointmentDate)
        ->where('appointment_time', $this->appointmentTime)
        ->first();

        if ($existingAppointment) {
            $this->errorMessage = 'Already have an appointment scheduled for this time and date!';
            return;
        }




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
        $this->termsAccepted = false;
    }

    public function searchServices()
    {

    }
}

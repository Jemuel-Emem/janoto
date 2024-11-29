<?php

namespace App\Livewire\Admin;

use App\Models\Appointment as APP;
use Livewire\Component;

class Schedule extends Component
{
    public function render()
    {
        $appointments = APP::where('status', 'confirmed')
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
            });

        return view('livewire.admin.schedule', [
            'appointments' => $appointments,
        ]);
    }
}

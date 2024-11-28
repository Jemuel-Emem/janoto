<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AddService extends Component
{
    use WithPagination, WithFileUploads;

    public $service_name;
    public $service_description;
    public $service_photo; // For file upload
    public $current_photo; // To display the current photo during edit
    public $service_id;
    public $add_service_modal = false;
    public $edit_service_modal = false;

    protected $rules = [
        'service_name' => 'required|string|max:255',
        'service_description' => 'required|string|max:1000',
        'service_photo' => 'nullable|image|max:2048', // Allow photo upload (2MB max)
    ];

    public function render()
    {
        $services = Service::paginate(10);
        return view('livewire.admin.add-service', compact('services'));
    }

    public function openAddModal()
    {
        $this->reset(['service_name', 'service_description', 'service_photo']);
        $this->add_service_modal = true;
    }

    public function submitService()
    {
        $this->validate();

        $photoPath = $this->service_photo
            ? $this->service_photo->store('services', 'public')
            : null;

        Service::create([
            'name' => $this->service_name,
            'description' => $this->service_description,
            'photo' => $photoPath,
        ]);

        $this->reset(['service_name', 'service_description', 'service_photo']);
        $this->add_service_modal = false;
        session()->flash('success', 'Service added successfully.');
    }

    public function closeModal(){
        $this->reset(['service_name', 'service_description', 'service_photo']);
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        $this->service_id = $service->id;
        $this->service_name = $service->name;
        $this->service_description = $service->description;
        $this->current_photo = $service->photo;
        $this->edit_service_modal = true;
    }

    public function updateService()
    {
        $this->validate();

        $service = Service::findOrFail($this->service_id);

        if ($this->service_photo) {
            // Delete the old photo if a new one is uploaded
            if ($service->photo) {
                Storage::disk('public')->delete($service->photo);
            }
            $service->photo = $this->service_photo->store('services', 'public');
        }

        $service->update([
            'name' => $this->service_name,
            'description' => $this->service_description,
            'photo' => $service->photo,
        ]);

        $this->reset(['service_name', 'service_description', 'service_photo']);  // Reset the form fields after update
        $this->edit_service_modal = false;
        session()->flash('success', 'Service updated successfully.');
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        if ($service->photo) {
            Storage::disk('public')->delete($service->photo);
        }
        $service->delete();

        session()->flash('success', 'Service deleted successfully.');
    }
}

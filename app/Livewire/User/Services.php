<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;

class Services extends Component
{
    use WithPagination;

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

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedService = null;
    }

    public function searchServices(){

    }
}


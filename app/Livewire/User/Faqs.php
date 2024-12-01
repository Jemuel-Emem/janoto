<?php

namespace App\Livewire\User;

use App\Models\faqstable as FAQ;
use Livewire\Component;

class Faqs extends Component
{
    public function render()
    {

        $faqs = FAQ::paginate(5);
        return view('livewire.user.faqs', compact('faqs'));
    }
}

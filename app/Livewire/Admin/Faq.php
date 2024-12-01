<?php

namespace App\Livewire\Admin;

use App\Models\faqstable;
use Livewire\Component;

class Faq extends Component
{
    public $faqs;             // To hold the list of FAQs
    public $add_faq_modal = false; // Control for the "Add FAQ" modal
    public $edit_faq_modal = false; // Control for the "Edit FAQ" modal
    public $title;            // FAQ title input
    public $description;      // FAQ description input
    public $selectedFaq;      // Store the FAQ being edited

    public function mount()
    {
        $this->faqs = faqstable::all(); // Retrieve FAQs initially
    }

    // Open the Add FAQ Modal
    public function openAddFaqModal()
    {
        $this->resetForm(); // Clear inputs when opening the modal
        $this->add_faq_modal = true;
    }

    // Submit new FAQ (Add FAQ)
    public function submitFaq()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        faqstable::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        // Refresh FAQs and close modal
        $this->faqs = faqstable::all();
        $this->add_faq_modal = false;

        session()->flash('message', 'FAQ added successfully!');
    }

    // Open the Edit FAQ Modal with existing FAQ data
    public function openEditFaqModal($id)
    {
        $faq = faqstable::findOrFail($id); // Retrieve FAQ by ID
        $this->selectedFaq = $faq->id;    // Store selected FAQ ID
        $this->title = $faq->title;       // Populate form fields
        $this->description = $faq->description;
        $this->edit_faq_modal = true;
    }

    // Update an existing FAQ
    public function updateFaq()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        // Update the selected FAQ
        $faq = faqstable::findOrFail($this->selectedFaq);
        $faq->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        // Refresh FAQs and close modal
        $this->faqs = faqstable::all();
        $this->edit_faq_modal = false;

        session()->flash('message', 'FAQ updated successfully!');
    }

    // Delete an FAQ
    public function deleteFaq($id)
    {
        $faq = faqstable::findOrFail($id);
        $faq->delete();

        // Refresh FAQs after deletion
        $this->faqs = faqstable::all();

        session()->flash('message', 'FAQ deleted successfully!');
    }

    // Reset form fields
    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->selectedFaq = null;
    }

    public function render()
    {
        return view('livewire.admin.faq', ['faqs' => $this->faqs]);
    }
}

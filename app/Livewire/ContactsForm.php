<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactsForm extends Component
{
    public $telephone;
    public $telephone_opening_hours;
    public $email;
    public $address;

    public function mount()
    {
        $contacts = Contact::all()->first();
        $this->telephone = $contacts->telephone;
        $this->telephone_opening_hours = $contacts->telephone_opening_hours;
        $this->email = $contacts->email;
        $this->address = $contacts->address;
    }

    public function render()
    {
        return view('livewire.contacts-form');
    }

    public function updateContacts()
    {
        $this->validate([
            'telephone' => 'required|string|max:255',
            'telephone_opening_hours' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Update the contacts
        $contacts = Contact::all()->first();
        $contacts->telephone = $this->telephone;
        $contacts->telephone_opening_hours = $this->telephone_opening_hours;
        $contacts->email = $this->email;
        $contacts->address = $this->address;
        $contacts->save();

        session()->flash('message', 'Contacts updated successfully');
    }
}

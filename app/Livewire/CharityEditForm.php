<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class CharityEditForm extends Component
{
    public $charity;

    public function mount($charity)
    {
        $this->charity = $charity;
    }

    public function render()
    {
        return view('livewire.charity-edit-form');
    }
}

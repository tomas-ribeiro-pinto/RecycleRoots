<?php

namespace App\Livewire;

use App\Models\Bin;
use App\Models\BinLocation;
use App\Models\Item;
use App\Models\Team;
use App\Models\TeamPostcode;
use Livewire\Component;

class BinLocationEditWizzard extends Component
{
    public $postcode;
    public $selectedBin;

    public function mount($binLocation)
    {
        $this->selectedBin = $binLocation;
        $this->postcode = $binLocation->teamPostcode;
    }

    public function render()
    {
        return view('livewire.bin-location-edit-wizzard');
    }

    public function addBin()
    {
        $this->dispatch('addBin');
    }

    public function deleteBin()
    {
        $this->selectedBin->delete();

        return redirect(route('bin-rules'))->with('message', 'Bin location removed');
    }
}

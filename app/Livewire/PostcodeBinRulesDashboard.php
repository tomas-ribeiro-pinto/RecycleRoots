<?php

namespace App\Livewire;

use App\Models\Bin;
use App\Models\BinLocation;
use Livewire\Component;

class PostcodeBinRulesDashboard extends Component
{
    public $postcode;
    public $binLocations;
    public $selectedBin;
    public $selectedBinItems;
    public $filterEmpty;
    public $filter;

    public function mount($postcode, $binLocations)
    {
        $this->postcode = $postcode;
        $this->binLocations = $binLocations;
        $this->selectedBin = $binLocations->first();
        if($this->selectedBin != null)
        {
            $this->clearFilter();
        }
        else
        {
            $this->selectedBinItems = [];
            $this->filterEmpty = true;
            $this->filter = '';
        }
    }

    public function render()
    {
        return view('livewire.postcode-bin-rules-dashboard');
    }

    public function selectBin($id)
    {
        $this->selectedBin = BinLocation::find($id);
        $this->clearFilter();
    }

    public function updatedFilter()
    {
        if($this->filter == '')
        {
            $this->clearFilter();
            return;
        }
        $this->filterEmpty = false;
        $this->selectedBinItems = array_filter($this->selectedBinItems, function($item) {
            return str_contains(strtoupper($item['item']['name']), strtoupper($this->filter));
        });
    }

    public function clearFilter()
    {
        $this->filterEmpty = true;
        $this->filter = '';
        $this->selectedBinItems = $this->selectedBin->getItems();
    }
}

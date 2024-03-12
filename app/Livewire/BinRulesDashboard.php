<?php

namespace App\Livewire;

use App\Models\TeamPostcode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BinRulesDashboard extends Component
{
    public $postcodes;
    public $teamPostcodes;
    public $filter;
    public $filterEmpty;
    public function mount()
    {
        $this->clearFilter();
        $this->filter = '';
        $this->teamPostcodes = auth()->user()->currentTeam->postcodes;
        $this->postcodes = $this->teamPostcodes;
    }

    public function render()
    {
        return view('livewire.bin-rules-dashboard');
    }

    public function updatedFilter()
    {
        if($this->filter == '')
        {
            $this->clearFilter();
            return;
        }
        $this->filterEmpty = false;
        $this->postcodes = $this->teamPostcodes->filter( function ($teamPostcode) {
            return str_contains(strtoupper($teamPostcode->postcode), strtoupper($this->filter));
        });
    }

    public function clearFilter()
    {
        $this->filterEmpty = true;
        $this->filter = '';
        $this->postcodes = $this->teamPostcodes;
    }
}

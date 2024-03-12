<?php

namespace App\Livewire;

use App\Models\Bin;
use App\Models\Item;
use App\Models\Team;
use App\Models\TeamPostcode;
use Livewire\Component;

class BinLocationWizzard extends Component
{
    // Postcode Selection
    public $search;
    public $postcodes;
    public $teamPostcodes;
    public $items;
    public $selectedItem;
    public $highlightIndex;
    public $searchEmpty;

    // Bin Selection
    public $selectedBin;
    public $bins;
    public $myTemplates;
    public $templates;
    public $myTemplatesToggle;
    public $submitDisabled;

    public function mount()
    {
        // Set templates variable (bins that are general templates)
        $this->templates = Bin::all()
                ->where('team_id', null)
                ->where('is_template', true);
        // Set my templates variable (templates created by the user's team)
        $this->myTemplates = Bin::all()
                ->where('team_id', auth()->user()->currentTeam->id)
                ->where('is_template', true);

        // Set bins list to templates
        $this->bins = $this->templates;
        $this->myTemplatesToggle = false;

        $this->submitDisabled = true;
        $this->selectedBin = null;
        $this->searchEmpty = true;
        $this->clearSearch();
        $this->postcodes = [];
        $this->items = [];
        $this->teamPostcodes = auth()->user()->currentTeam->postcodes;
    }

    public function render()
    {
        return view('livewire.bin-location-wizzard');
    }

    public function updatedSearch()
    {
        if($this->search == '')
        {
            $this->clearSearch();
            return;
        }
        $this->selectedItem = -1;
        $this->items = $this->teamPostcodes->filter( function ($teamPostcode) {
            return str_contains(strtoupper($teamPostcode->postcode), strtoupper($this->search))
                && !in_array($teamPostcode, $this->postcodes);
        });
        $this->items->count() > 0 ?: $this->items = [];
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->highlightIndex = 0;
        $this->items = [];
        $this->selectedItem = -1;
    }

    public function incrementHighlight()
    {
        if($this->highlightIndex === count($this->items) - 1)
        {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if($this->highlightIndex === 0)
        {
            $this->highlightIndex = count($this->items) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectItemFromList()
    {
        $this->addItem($this->items[$this->highlightIndex]['id']);
    }

    public function addItem($id)
    {
        $this->searchEmpty = false;
        $this->selectedItem = TeamPostcode::find($id);
        array_push($this->postcodes, $this->selectedItem);
        $this->clearSearch();
        $this->assessSubmit();
    }

    public function removeItems()
    {
        $this->searchEmpty = true;
        $this->postcodes = [];
        $this->assessSubmit();
    }

    public function selectBin($id)
    {
        $this->selectedBin = Bin::find($id);
        $this->assessSubmit();
    }

    public function clearBin()
    {
        $this->selectedBin = null;
        $this->assessSubmit();
    }

    public function toggleMyTemplates()
    {
        if($this->myTemplatesToggle)
        {
            $this->myTemplatesToggle = false;
            $this->bins = $this->templates;
        }
        else
        {
            $this->myTemplatesToggle = true;
            $this->bins = $this->myTemplates;
        }
    }

    public function assessSubmit()
    {
        if($this->selectedBin != null
            && count($this->postcodes) > 0)
        {
            $this->submitDisabled = false;
        }
        else
        {
            $this->submitDisabled = true;
        }
    }

    public function addBin()
    {
        $this->dispatch('addBin');
    }
}

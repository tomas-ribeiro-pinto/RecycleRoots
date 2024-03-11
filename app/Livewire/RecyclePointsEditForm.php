<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\RecyclePoint;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecyclePointsEditForm extends Component
{
    public $recyclePoint;
    public $postcode;
    public $lat;
    public $lng;
    public $message;
    public $using_postcode;
    public $filter;
    public $search;
    public $items;
    public $recycleItems;
    public $selectedItem;
    public $highlightIndex;
    public $filterEmpty;
    public $searchEmpty;

    public function mount($recyclePoint)
    {
        $this->clearFilter();
        $this->clearSearch();
        $this->recyclePoint = $recyclePoint;
        $this->recycleItems = $recyclePoint->items;
        $this->resetQuery();
    }

    public function render()
    {
        return view('livewire.recycle-points-edit-form');
    }

    public function updatedFilter()
    {
        if($this->filter == '')
        {
            $this->clearFilter();
            return;
        }
        $this->filterEmpty = false;
        $this->recycleItems = $this->recyclePoint->items()
            ->where('name', 'like', '%'.$this->filter.'%')
            ->get();
    }

    public function clearFilter()
    {
        $this->filterEmpty = true;
        $this->filter = '';
        $this->recycleItems = $this->recyclePoint->items;
    }

    public function updatedSearch()
    {
        if($this->search == '')
        {
            $this->clearSearch();
            return;
        }
        $this->searchEmpty = false;
        $this->selectedItem = -1;
        $this->items = Item::where('name', 'like', '%'.$this->search.'%')
            ->take(6)
            ->get()
            ->toArray();
    }

    // Clear Postcode search
    public function clearSearch()
    {
        $this->searchEmpty = true;
        $this->search = '';
        $this->highlightIndex = 0;
        $this->items = [];
        $this->selectedItem = -1;
    }

    public function selectItem($id)
    {
        $item = Item::find($id);
        $this->items = [];
        $this->selectedItem = $id;
        $this->search = $item->name;
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
        $this->selectItem($this->items[$this->highlightIndex]['id']);
    }

    public function addItem()
    {
        if($this->selectedItem == -1)
        {
            return;
        }
        $this->recyclePoint->items()->attach($this->selectedItem);
        $this->recycleItems = $this->recyclePoint->items;
        $this->clearSearch();
    }

    public function removeCharityItem($id)
    {
        $this->recyclePoint->items()->detach($id);
        $this->recycleItems = $this->recyclePoint->items;
    }

    public function resetQuery()
    {
        $this->postcode = '';
        $this->lat = $this->recyclePoint->lat;
        $this->lng = $this->recyclePoint->lng;
        $this->message = '';
        $this->using_postcode = false;
    }

    public function searchPostcode()
    {
        if ($this->postcode == '') {
            $this->message = 'Please enter a postcode';
        }
        else
        {
            // Call Postcode.io API to fetch coordinates of postcode search
            $response = Http::get('https://api.postcodes.io/postcodes/'. $this->postcode);

            // If the response is successful, get the latitude and longitude of the search location
            if($response->status() == 200) {
                $response = json_decode($response);
                $this->lat = $response->result->latitude;
                $this->lng = $response->result->longitude;
                $this->postcode = '';
                $this->message = '';
                $this->using_postcode = false;
            }
            else if($response->status() == 404) {
                $this->message = "Please enter a valid postcode.";
            }
            else {
                $this->message = "An error occurred. Please try again or use the coordinates tab.";
            }
        }
    }
}

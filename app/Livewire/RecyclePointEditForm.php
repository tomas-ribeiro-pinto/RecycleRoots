<?php

namespace App\Livewire;

use App\Models\RecyclePoint;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class RecyclePointEditForm extends Component
{

    public $recyclePoint;
    public $postcode;
    public $lat;
    public $lng;
    public $message;
    public $using_postcode;

    public function mount($recyclePoint)
    {
        $this->recyclePoint = RecyclePoint::find($recyclePoint);
        $this->resetQuery();
    }

    public function resetQuery()
    {
        $this->postcode = '';
        $this->lat = $this->recyclePoint->lat;
        $this->lng = $this->recyclePoint->lng;
        $this->message = '';
        $this->using_postcode = false;
    }

    public function render()
    {
        return view('livewire.recycle-point-edit-form');
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
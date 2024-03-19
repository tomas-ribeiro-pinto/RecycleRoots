<?php

namespace App\Livewire;

use App\Http\Controllers\PostcodesAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class RecyclePointForm extends Component
{
    public $postcode;
    public $lat;
    public $lng;
    public $message;
    public $using_postcode;

    public function mount()
    {
        $this->resetQuery();
    }

    public function resetQuery()
    {
        $this->postcode = '';
        $this->lat = '';
        $this->lng = '';
        $this->message = '';
        $this->using_postcode = true;
    }

    public function render()
    {
        return view('livewire.recycle-point-form');
    }
    public function searchPostcode()
    {
        if ($this->postcode == '') {
            $this->message = 'Please enter a postcode';
        }
        else
        {
            // Call Postcode.io API to fetch outcode of postcode search
            $postcodeResponse = (new PostcodesAPIController)->searchPostcode($this->postcode);
            $postcodeResponse = json_decode($postcodeResponse->content());

            // If the response is successful, get the latitude and longitude of the search location
            if($postcodeResponse->status == 200) {
                $this->lat = $postcodeResponse->response->latitude;
                $this->lng = $postcodeResponse->response->longitude;
                $this->postcode = '';
                $this->message = '';
                $this->using_postcode = false;
            }
            else if($postcodeResponse->status == 404) {
                $this->message = "Please enter a valid postcode.";
            }
            else {
                $this->message = "An error occurred. Please try again or use the coordinates tab.";
            }
        }
    }
}

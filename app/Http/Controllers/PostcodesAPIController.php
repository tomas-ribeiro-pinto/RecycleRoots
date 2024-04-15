<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostcodesAPIController extends Controller
{
    public $api_path = 'https://api.postcodes.io';

    /**
     * Search for a postcode and return the response.
     */
    public function searchPostcode($postcode)
    {
        $endpoint = "/postcodes/";

        // If the postcode is not set or empty, return an error message in JSON
        if($postcode != null || $postcode != "") {

            // Call Postcode.io API
            $response = Http::get($this->api_path . $endpoint . $postcode);

            // If the response is successful return a JSON response
            if($response->status() == 200) {
                return response()->json(['status' => 200, 'response' => json_decode($response)->result]);
            }
            else if($response->status() == 404) {
                return response()->json(['status' => 404, 'message' => 'Please enter a valid postcode.'], 404);
            }
            else {
                return response()->json(['status' => 500, 'message' => 'An error occurred. Please try again.'], 500);
            }
        }

        return response()->json(['status' => 422, 'message' => 'Please enter a valid postcode.'], 422);
    }
}

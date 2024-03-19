<?php

namespace App\Http\Controllers;

use App\Models\RecyclePoint;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

class MapController extends Controller
{
    /**
     * Assess the postcode validity and display the map of recycling centres.
     */
    public function index(Request $request)
    {
        $search = $request->input('postcode');

        // If the postcode is not set, redirect to the home page
        if($search != null || $search != "") {

            // Call API to fetch recycle centres
            $request = Request::create('/api/recycle-centres', 'GET',[
                'postcode' => $search
            ]);

            $response = json_decode(Route::dispatch($request)->getContent());

            // If the response is successful, get the latitude and longitude of the search location
            if($response->status == 200) {
                $lat = $response->postcode->latitude;
                $lng = $response->postcode->longitude;

                return $this->show($lat, $lng, $search, $response->response);
            }
            else {
                return back()->dangerBanner($response->message);
            }
        }

        return back()->dangerBanner('Please enter a valid postcode.');
    }

    /**
     * Display the map of recycling centres with markers.
     */
    public function show($lat, $lng, $search, $recyclePoints): View
    {
        // Create an array of markers to be displayed in the leaflet map
        $markers = [];
        foreach ($recyclePoints as $recyclePoint) {
            $markers[] = [
                'lat' => $recyclePoint->lat,
                'long' => $recyclePoint->lng,
                'info' => $recyclePoint->name,
            ];
        }

        return view('recycle-points-map', compact("lat", "lng", "markers", "search", "recyclePoints"));
    }

    /**
     * Calculate the distance between two coordinates
     */
    public function calculateCoordinateDistance($coord1, $coord2)
    {
        $EARTH_RADIUS = 6371;

        $lat1 = $coord1[0];
        $lng1 = $coord1[1];
        $lat2 = $coord2[0];
        $lng2 = $coord2[1];

        // Formula to calculate distance between two coordinates
        $result = acos(sin(deg2rad($lat1))*sin(deg2rad($lat2))+cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($lng2)-deg2rad($lng1)))*$EARTH_RADIUS;

        // Convert the distance from km to miles
        $result /= 1.609344;

        return number_format($result, 2, '.', ',');
    }
}

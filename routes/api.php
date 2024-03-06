<?php

use App\Http\Controllers\MapController;
use App\Models\RecyclePoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/items', function () {

    $items = \App\Models\Item::all();

    return response()->json(['status' => 200, 'response' => $items], 200);
});

Route::get('/item-types', function () {

    $types = \App\Models\ItemType::all();

    return response()->json(['status' => 200, 'response' => $types], 200);
});

Route::get('/charities', function () {

    $charities = \App\Models\Charity::all();

    return response()->json(['status' => 200, 'response' => $charities], 200);
});

Route::get('/recycle-centres', function (Request $request) {

    // Get all recycle points
    $recyclePoints = RecyclePoint::all();

    if($request->query('postcode'))
    {
        $postcode = $request->query('postcode');

        // If the postcode is not set, abort the request
        if($postcode != null || $postcode != "") {

            // Call Postcode.io API to fetch coordinates of postcode search
            $response = Http::get('https://api.postcodes.io/postcodes/'. $postcode);

            // If the response is successful, get the latitude and longitude of the search location
            if($response->status() == 200) {
                $response = json_decode($response);
                $lat = $response->result->latitude;
                $lng = $response->result->longitude;

                // Orders the recycle points by distance from the search location
                foreach ($recyclePoints as $recyclePoint) {
                    $mapController = new MapController();
                    $recyclePoint->distance_in_miles = $mapController->calculateCoordinateDistance([$lat, $lng], [$recyclePoint->lat, $recyclePoint->lng]);
                }

                $recyclePoints = $recyclePoints->sortBy('distance_in_miles');
                return response()->json(['status' => 200, 'response' => $recyclePoints], 200);
            }
            else if($response->status() == 404) {
                return response()->json(['status' => 404, 'message' => 'Please enter a valid postcode.'], 404);
            }
            else {
                return response()->json(['status' => 500, 'message' => 'An error occurred. Please try again.'], 500);

            }
        }
        return response()->json(['status' => 404,'message' => 'Please enter a valid postcode. Parameters missing.'], 404);
    }

    return response()->json(['status' => 200, 'response' => $recyclePoints], 200);
});
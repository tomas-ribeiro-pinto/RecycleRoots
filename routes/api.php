<?php

use App\Http\Controllers\MapController;
use App\Http\Controllers\PostcodesAPIController;
use App\Models\BinLocation;
use App\Models\Charity;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\RecyclePoint;
use App\Models\TeamPostcode;
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

    $items = Item::all();

    return response()->json(['status' => 200, 'response' => $items], 200);
});

Route::get('/item-types', function () {

    $types = ItemType::all();

    return response()->json(['status' => 200, 'response' => $types], 200);
});

Route::get('/charities', function (Request $request) {

    $item = $request->query('item');
    $item = Item::where('name', $item)->first();

    // Get all charities
    $charities = Charity::all();

    if($item == null) {
        return response()->json(['status' => 200, 'postcode' => null, 'response' => $charities], 200);
    }

    // Filter the charities to only display those that accept the item
    $charities = $charities->filter(function($charity) use ($item) {
        return $charity->searchAcceptedItem($item);
    });

    return response()->json(['status' => 200, 'response' => $charities], 200);
});

Route::get('/recycle-centres', function (Request $request) {

    $item = $request->query('item');
    $postcode = $request->query('postcode');

    // Get all recycle points
    $recyclePoints = RecyclePoint::all();

    if($postcode == null) {
        return response()->json(['status' => 200, 'postcode' => null, 'response' => $recyclePoints], 200);
    }

    // Call Postcode.io API to fetch coordinates of postcode search
    $postcodeResponse = (new PostcodesAPIController)->searchPostcode($postcode);
    // Decode the response
    $postcodeResponse = json_decode($postcodeResponse->content());

    // If the response is successful, get the latitude and longitude of the search location
    if($postcodeResponse->status == 200)
    {
        $lat = $postcodeResponse->response->latitude;
        $lng = $postcodeResponse->response->longitude;
    }
    else
    {
        return $postcodeResponse;
    }

    // Orders the recycle points by distance from the search location
    foreach ($recyclePoints as $recyclePoint) {
        $mapController = new MapController();
        $recyclePoint->distance_in_miles = $mapController->calculateCoordinateDistance([$lat, $lng], [$recyclePoint->lat, $recyclePoint->lng]);
    }

    // Sort the recycle points by distance (miles)
    $recyclePoints = $recyclePoints->sortBy('distance_in_miles');

    // Filter the recycle points to only display those within 10 miles of the search location
    $recyclePoints = $recyclePoints->filter(function($recyclePoint) {
        return $recyclePoint->distance_in_miles <= 10;
    });

    // If no recycle points are found within 10 miles of the search location, return a 404 status
    if($recyclePoints->isEmpty()) {
        return response()->json(['status' => 200, 'message' => 'No recycle points found within 10 miles of the search location.',
            'postcode' => $postcodeResponse->response, 'response' => $recyclePoints], 200);
    }

    if ($item != null) {
        $item = Item::where('name', $item)->first();
        // Filter the recycle points to only display those that accept the item
        $recyclePoints = $recyclePoints->filter(function($recyclePoint) use ($item) {
            return $recyclePoint->items->contains($item);
        });
    }

    return response()->json(['status' => 200, 'postcode' => $postcodeResponse->response, 'response' => $recyclePoints], 200);
});


Route::get('/recycle', function (Request $request) {

    $item = Item::where('name', $request->query('item'))->first();
    $postcode = $request->query('postcode');

    if ($postcode == null) {
        return response()->json(['status' => 404, 'message' => 'Please enter a valid postcode.'], 404);
    }

    // Call Postcode.io API to fetch outcode of postcode search
    $postcodeResponse = (new PostcodesAPIController)->searchPostcode($postcode);
    $postcodeResponse = json_decode($postcodeResponse->content());

    // If the response is successful, get the outcode of the postcode
    if ($postcodeResponse->status == 200) {
        $postcode = $postcodeResponse->response->outcode;
    }
    else {
        return $postcodeResponse;
    }

    // If the item is not found, return empty response
    if ($item == null) {
        return response()->json(['status' => 200, 'postcode' => $postcodeResponse->response,
            'response' => [
                'bin_rules' => null,
                'recycle_points' => null,
                'charities' => null
            ]], 200);
    }

    $teamPostcode = TeamPostcode::where('postcode', $postcode)->first();

    if($teamPostcode != null)
    {
        $binLocations = BinLocation::where('team_postcode_id', $teamPostcode->id)->get();

        $binLocations = $binLocations->filter(function ($binLocation) use ($item) {
            return $binLocation->searchAcceptedItem($item);
        });
    }
    else
    {
        $binLocations = [];
    }


    // Call API to fetch recycle centres that accept the item
    $request = Request::create('/api/recycle-centres', 'GET',[
        'item' => $item->name,
        'postcode' => $postcode
    ]);
    $response = Route::dispatch($request);
    $response = json_decode($response->getContent(), true);

    if($response['status'] == 200) {
        $recyclePoints = array_slice($response['response'], 0, 3);
    }
    else {
        return $response;
    }

    // Call API to fetch recycle centres that accept the item
    $request = Request::create('/api/charities', 'GET',[
        'item' => $item->name
    ]);
    $response = Route::dispatch($request);
    $response = json_decode($response->getContent(), true);

    if($response['status'] == 200) {
        $charities = $response['response'];
    }
    else {
        return $response;
    }

    return response()->json(['status' => 200, 'postcode' => $postcodeResponse->response,
        'response' => [
            'bin_rules' => $binLocations,
            'recycle_points' => $recyclePoints,
            'charities' => $charities
        ]], 200);
});

<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\BinLocation;
use App\Models\TeamPostcode;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class SearchResultController extends Controller
{
    /**
     *  Validate Post Request and
     *  Show the search results page.
     * @return View
     */
    public function index(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'postcode' => 'required'
        ]);

        $item = $request->input('item');
        $postcode = $request->input('postcode');


        // Call API to fetch bins that can be used to recycle the item
        $request = Request::create('/api/recycle', 'GET',[
            'item' => $item,
            'postcode' => $postcode
        ]);

        $response = json_decode(Route::dispatch($request)->getContent());

        // If the response is successful, get the bin locations for recycling at home
        if ($response->status == 200) {
            $homeBins = $response->response->bin_rules ?? [];
            $recycleCentres = $response->response->recycle_points ?? [];
            $charities = $response->response->charities ?? [];
        }
        else if ($response->status == 404) {
            return back()->dangerBanner('Please enter a valid postcode.');
        }
        else {
            return back()->dangerBanner('An error occurred. Please try again.');
        }

        // Ensure return is an array and not a StdClass object
        $homeBins = json_encode($homeBins);
        $homeBins = json_decode($homeBins, true);

        // Check if the bins can be used to recycle the item
        if($homeBins != []) {
            $isRecyclable = $this->checkIfRecyclable($homeBins);
            if ($isRecyclable) {
                $homeBins = array_filter($homeBins, function($bin) {
                    return $bin['bin']['is_recycle_bin'];
                });
            }
        }

        return view('item-search-results', [
            'search' => $item,
            'postcode' => $postcode,
            'homeBins' => $homeBins,
            'recycleCentres' => $recycleCentres,
            'charities' => $charities,
            'isRecyclable' => $isRecyclable ?? false
        ]);
    }

    /**
     * Check if the bins can be used to recycle the item
     * @param array $homeBins
     */
    private function checkIfRecyclable(array $homeBins)
    {
        $t_bins = array_filter($homeBins, function($bin) {
            return $bin['bin']['is_recycle_bin'];
        });

        if(count($t_bins) > 0) {
            $isRecyclable = true;
        }
        else
        {
            $isRecyclable = false;
        }

        return $isRecyclable;
    }
}

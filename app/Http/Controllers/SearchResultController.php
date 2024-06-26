<?php

namespace App\Http\Controllers;

use App\Mail\ItemRequestGuidance;
use App\Models\Bin;
use App\Models\BinLocation;
use App\Models\Charity;
use App\Models\Post;
use App\Models\TeamPostcode;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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
            $articles = $response->response->articles ?? [];
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

        $charities = json_encode($charities);
        $charities = json_decode($charities, true);

        $articles = json_encode($articles);
        $articles = json_decode($articles, true);

        // Create a new collection of Post objects
        $newArticles = collect();
        foreach ($articles as $article)
        {
            $object = new Post([
                'id' => $article['id'],
                'user_id' => $article['user_id'],
                'title' => $article['title'],
                'slug' => $article['slug'],
                'thumbnail_path' => $article['thumbnail_path'],
                'is_published' => $article['is_published'],
                'created_at' => $article['created_at'],
                'updated_at' => $article['updated_at']
            ]);

            $newArticles->push($object);
        }

        $articles = $newArticles->take(3);

        // Create a new collection of Charity objects
        $newCharities = collect();
        foreach ($charities as $charity)
        {
            $object = new Charity([
                'id' => $charity['id'],
                'name' => $charity['name'],
                'website' => $charity['website'],
                'description' => $charity['description'],
                'phone' => $charity['phone'],
                'email' => $charity['email'],
                'charity_registration' => $charity['charity_registration'],
                'created_at' => $charity['created_at'],
                'updated_at' => $charity['updated_at']
            ]);

            $newCharities->push($object);
        }

        $charities = $newCharities;

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
            'isRecyclable' => $isRecyclable ?? false,
            'articles' => $articles ?? []
        ]);
    }

    public function sendItemRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'postcode' => 'required|max:10',
            'email' => 'required|email|max:255',
            'item' => 'required|string|max:255',
            'message' => 'max:300',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $postcode = $request->input('postcode');
        $item = $request->input('item');
        $message = $request->input('message') ?? 'N/A';

        // Send email to the admin team owner
        // TODO: Change this to the actual admin team owner, using email from environment variable for testing purposes
        Mail::to(env('TEST_EMAIL'))->send(new ItemRequestGuidance($name, $email, $postcode, $item, $message));

        return back()->with('message', 'Your request has been sent successfully!');
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

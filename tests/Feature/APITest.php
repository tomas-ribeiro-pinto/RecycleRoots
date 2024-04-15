<?php

namespace Tests\Feature;

use App\Models\Bin;
use App\Models\BinItem;
use App\Models\BinLocation;
use App\Models\Charity;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\Post;
use App\Models\RecyclePoint;
use App\Models\Team;
use App\Models\TeamPostcode;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class APITest extends TestCase
{
    public function test_get_items_from_api(): void
    {
        $response = $this->get('/api/items');

        $response->assertStatus(200);

        $request = Request::create('/api/items', 'GET');
        $request = Route::dispatch($request);
        $items_api = json_decode($request->getContent(), true);

        $items_api = $items_api['response'];
        $items = Item::all();

        $this->assertCount($items->count(), $items_api);
    }

    public function test_get_item_types_from_api(): void
    {
        $response = $this->get('/api/item-types');

        $response->assertStatus(200);

        $request = Request::create('/api/item-types', 'GET');
        $request = Route::dispatch($request);
        $item_types_api = json_decode($request->getContent(), true);

        $item_types_api = $item_types_api['response'];
        $item_types = ItemType::all();

        $this->assertCount($item_types->count(), $item_types_api);
    }

    public function test_get_charities_from_api(): void
    {
        $response = $this->get('/api/charities');

        $response->assertStatus(200);

        $request = Request::create('/api/charities', 'GET');
        $request = Route::dispatch($request);
        $charities_api = json_decode($request->getContent(), true);

        $charities_api = $charities_api['response'];
        $charities = Charity::all();

        $this->assertCount($charities->count(), $charities_api);
    }

    public function test_get_charities_from_api_with_item_parameter(): void
    {
        $item = Item::factory()->create();
        $response = $this->get('/api/charities', [
            'item' => $item->name
        ]);

        $response->assertStatus(200);

        $request = Request::create('/api/charities', 'GET', [
            'item' => $item->name
        ]);
        $request = Route::dispatch($request);
        $charities_api = json_decode($request->getContent(), true);

        $charities_api = $charities_api['response'];
        $charities = Charity::all()->where('items', 'like', '%' . $item->name . '%');

        $this->assertCount($charities->count(), $charities_api);
    }

    public function test_get_recycle_centres(): void
    {
        $response = $this->get('/api/recycle-centres');

        $response->assertStatus(200);

        $request = Request::create('/api/recycle-centres');
        $request = Route::dispatch($request);
        $recycle_centres_api = json_decode($request->getContent(), true);

        $recycle_centres_api = $recycle_centres_api['response'];
        $recycle_centres = RecyclePoint::all();

        $this->assertCount($recycle_centres->count(), $recycle_centres_api);
    }

    public function test_get_recycle_centres_with_parameters(): void
    {
        $item = Item::find(1);
        $response = $this->get('/api/recycle-centres', [
            'item' => $item->name,
            'postcode' => "HP11 2ET"
        ]);

        $response->assertStatus(200);

        $request = Request::create('/api/recycle-centres', 'GET', [
            'item' => $item->name,
        ]);
        $request = Route::dispatch($request);
        $recycle_centres_api = json_decode($request->getContent(), true);

        $recycle_centres_api = $recycle_centres_api['response'];
        $recycle_centres = RecyclePoint::all()->where('items', 'like', '%' . $item->name . '%');

        $this->assertCount($recycle_centres->count(), $recycle_centres_api);
    }

//    public function test_get_recycle_guidance_with_parameters(): void
//    {
//        $user = User::factory()->create();
//        $team = Team::factory()->create();
//        $user->teams()->attach($team,['role' => 'admin']);
//        $user->current_team_id = $team->id;
//
//        $bin = Bin::create([
//            'name' => "test",
//            'team_id' => $team->id,
//            'dimensions' => "test",
//            'color' => "test",
//            'is_template' => 1,
//            'is_recycle_bin' => 1
//        ]);
//
//        $bin->save();
//
//        $teamPostcode = TeamPostcode::create([
//            'team_id' => $team->id,
//            'postcode' => "HP11"
//        ]);
//
//        $binLocation = BinLocation::create([
//            'team_postcode_id' => 1,
//            'bin_id' => $bin->id
//        ]);
//
//        $item = Item::factory()->create();
//        $bin->items()->attach($item);
//
//        $postcode = "HP112ET";
//
//        $request = Request::create('/api/recycle', 'GET',[
//            'item' => "ipsam",
//            'postcode' => $postcode
//        ]);
//        $response = json_decode(Route::dispatch($request)->getContent());
//
//        $this->assertTrue($response->status == 200);
//    }

    public function test_cannot_get_recycle_guidance_without_postcode(): void
    {
        $item = Item::factory()->create();
        $response = $this->get('/api/recycle', [
            'item' => $item->name,
        ]);

        $response->assertStatus(422);
    }

    public function test_get_blog_articles(): void
    {
        $response = $this->get('/api/blog');

        $response->assertStatus(200);

        $request = Request::create('/api/blog');
        $request = Route::dispatch($request);
        $blog_api = json_decode($request->getContent(), true);

        $blog_api = $blog_api['response'];
        $blog = Post::all();

        $this->assertCount($blog->count(), $blog_api);
    }

    public function test_get_blog_articles_with_item_parameter(): void
    {
        $item = Item::find(1);
        $response = $this->get('/api/blog', [
            'item' => $item->name
        ]);

        $response->assertStatus(200);

        $request = Request::create('/api/blog', 'GET', [
            'item' => $item->name
        ]);
        $request = Route::dispatch($request);
        $blog_api = json_decode($request->getContent(), true);

        $blog_api = $blog_api['response'];

        // Filter the posts to only display those that accept the item
        $blog = Post::all()->filter(function($post) use ($item) {
            return $post->items->contains($item);
        });

        $this->assertCount($blog->count(), $blog_api);
    }
}

<?php

namespace Tests\Feature;

use App\Livewire\AddItemToModelMenu;
use App\Livewire\RecyclePointsEditForm;
use App\Models\Item;
use App\Models\RecyclePoint;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RecycleCentreTest extends TestCase
{
    public function test_get_recycle_centres(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->teams()->attach($team,['role' => 'admin']);
        $user->current_team_id = $team->id;

        $response = $this->actingAs($user)->get('/recycle-centres');

        $response->assertStatus(200);
    }

    public function test_add_recycle_centres(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->teams()->attach($team,['role' => 'admin']);
        $user->current_team_id = $team->id;

        $recycle_centre = RecyclePoint::make([
            'id' => 1,
            'team_id' => $team->id,
            'name' => 'Recycle Centre',
            'address' => '123 Fake Street',
            'managed_by' => $user->name,
            'lat' => '-50.54975',
            'lng' => '-165.30337',
            'description' => 'A description of the recycle centre',
            'website' => 'https://example.com',
        ]);

        $response = $this->actingAs($user)
            ->post('/recycle-centres/add', [
                'team_id' => $recycle_centre->team_id,
                'name' => $recycle_centre->name,
                'address' => $recycle_centre->address,
                'managed_by' => $recycle_centre->managed_by,
                'lat' => $recycle_centre->lat,
                'lng' => $recycle_centre->lng,
                'description' => $recycle_centre->description,
                'website' => $recycle_centre->website,
        ]);

        // Asserts if the recycle centre was added to the database
        $this->assertModelExists($recycle_centre);
    }

    public function test_add_item_to_recycle_centre()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->teams()->attach($team,['role' => 'admin']);
        $user->current_team_id = $team->id;

        $item = Item::factory()->create();
        $recycle_centre = RecyclePoint::find(1);

        $recycle_centre->items()->attach($item);

        $this->assertCount(1, $recycle_centre->items);
    }

    public function test_remove_item_to_recycle_centre()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->teams()->attach($team,['role' => 'admin']);
        $user->current_team_id = $team->id;

        $item = Item::factory()->create();
        $recycle_centre = RecyclePoint::find(1);

        $recycle_centre->items()->detach($item);

        $this->assertCount(1, $recycle_centre->items);
    }

    public function test_edit_recycle_centre(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->teams()->attach($team,['role' => 'admin']);
        $user->current_team_id = $team->id;

        $recycle_centre = RecyclePoint::make([
            'id' => 1,
            'team_id' => $team->id,
            'name' => 'Recycle Centre 1',
            'address' => '123 Fake Street',
            'managed_by' => $user->name,
            'lat' => '-50.54975',
            'lng' => '-165.30337',
            'description' => 'A description of the recycle centre',
            'website' => 'https://example.com',
        ]);

        $this->actingAs($user)
            ->post('/recycle-centres/1/edit', [
                'team_id' => $recycle_centre->team_id,
                'name' => $recycle_centre->name,
                'address' => $recycle_centre->address,
                'managed_by' => $recycle_centre->managed_by,
                'lat' => $recycle_centre->lat,
                'lng' => $recycle_centre->lng,
                'description' => $recycle_centre->description,
                'website' => $recycle_centre->website,
            ]);

        $this->assertModelExists($recycle_centre);
    }

    public function test_delete_recycle_centre(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->teams()->attach($team,['role' => 'admin']);
        $user->current_team_id = $team->id;

        $recycle_centre = RecyclePoint::all()->first();

        $response = $this->actingAs($user)
            ->post('/recycle-centres/' . $recycle_centre->id .'/remove', [
                'id' => $recycle_centre->id
            ]);

        $this->assertModelMissing($recycle_centre);
    }
}

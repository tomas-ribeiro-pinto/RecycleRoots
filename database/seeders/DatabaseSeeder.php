<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bin;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\RecyclePoint;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = new User([
        'name' => 'Buckinghamshire Council',
        'email' => 'admin@admin.com',
        'password' => bcrypt('admin'),
        ]);
        $admin->save();

        $admin1 = new User([
        'name' => 'John Smith',
        'email' => 'johnsmith@admin.com',
        'password' => bcrypt('admin'),
        ]);
        $admin1->save();

        $blog = new User([
        'name' => 'Susan Johnson',
        'email' => 'susanjohnson@admin.com',
        'password' => bcrypt('admin'),
        ]);
        $blog->save();

        $team = new Team([
        'name' => 'Buckinghamshire Council',
        'personal_team' => true,
        'user_id' => $admin->id,
        ]);
        $team->save();

        $team->users()->attach($admin1, ['role' => 'admin']);
        $team->users()->attach($blog, ['role' => 'admin']);

        $postcodesSeeder = new PostcodesSeeder();
        $postcodesSeeder->run();

        $recyclePoints = [
            new RecyclePoint([
                'name' => 'High Wycombe recycling centre',
                'address' => 'Clay Lane, Booker, Buckinghamshire, SL7 3DJ',
                'lat' => '51.60488600747863',
                'lng' => '-0.7956837840719871',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/high-wycombe-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Beaconsfield recycling centre',
                'address' => 'A40 London Road, Lower Pyebushes, Buckinghamshire, HP9 2XB',
                'lat' => '51.59804057602368',
                'lng' => '-0.6135969764040702',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/beaconsfield-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Burnham recycling centre',
                'address' => 'Crowpiece Lane, Buckinghamshire, SL2 3TG',
                'lat' => '51.54335853433586',
                'lng' => '-0.6366802989734986',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/burnham-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Amersham recycling centre',
                'address' => 'London Road East, Amersham, HP7 9DT',
                'lat' => '51.65333021208072',
                'lng' => '-0.5846675417214581',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/amersham-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Aston Clinton recycling centre',
                'address' => 'College Road North, Buckinghamshire, HP22 5EZ',
                'lat' => '51.812716434896664',
                'lng' => '-0.7324014324905349',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/aston-clinton/'
            ]),
            new RecyclePoint([
                'name' => 'Aylesbury recycling centre',
                'address' => 'Rabans Close, Aylesbury, HP19 8RS',
                'lat' => '51.825077438666156',
                'lng' => '-0.8504570760962087',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/aylesbury-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Bledlow Ridge recycling centre',
                'address' => 'Wigans Lane, Bledlow Ridge, HP14 4BH',
                'lat' => '51.68851633988863',
                'lng' => '-0.8665020319266178',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/bledlow-ridge-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Chesham recycling centre',
                'address' => 'Latimer Road, Chesham, HP5 1TL',
                'lat' => '51.69056078811511',
                'lng' => '-0.5882834165835442',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/chesham-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Langley recycling centre',
                'address' => 'Langley Park Road, Langley, SL3 6DD',
                'lat' => '51.510364528216456',
                'lng' => '-0.5417714607741991',
                'managed_by' => 'Buckinghamshire Council',
                'team_id' => $team->id,
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/langley-recycling-centre/'
            ])
        ];

        foreach ($recyclePoints as $recyclePoint) {
            $recyclePoint->save();
        }

        $itemsSeeder = new ItemsSeeder();
        $itemsSeeder->run();

        $items = Item::all();

        foreach ($recyclePoints as $recyclePoint)
        {
            $recyclePoint
                ->items()
                ->attach([
                    $this->findItem('Aerosols', $items),
                    $this->findItem('Batteries', $items),
                    $this->findItem('Car batteries', $items),
                    $this->findItem('Carpet and rugs', $items),
                    $this->findItem('Clothes', $items),
                    $this->findItem('Cooking oil and fats', $items),
                    $this->findItem('Car oil', $items),
                    $this->findItem('Fluorescent tubes', $items),
                    $this->findItem('Furniture', $items),
                    $this->findItem('Paint (hardened)', $items),
                    $this->findItem('Garden waste', $items),
                    $this->findItem('General Waste', $items),
                    $this->findItem('Gas bottles', $items),
                    $this->findItem('Glass', $items),
            ]);
            $recyclePoint
                ->items()
                ->attach(
                    $this->findItemByType('Electrical Appliances', $items)->pluck('id'),
                );
            $recyclePoint
                ->items()
                ->attach(
                    $this->findItemByType('Building Materials', $items)->pluck('id'),
                );
            $recyclePoint
                ->items()
                ->attach(
                    $this->findItemByType('Bathroom Suites', $items)->pluck('id'),
                );
            $recyclePoint
                ->items()
                ->attach(
                    $this->findItemByType('Asbestos', $items)->pluck('id'),
                );
        }

        $templatesSeeder = new TemplatesSeeder();
        $templatesSeeder->run();
    }

    public function findItem($name, $items)
    {
        $result = $items->filter(function($item) use ($name) {
            return $item->name == $name;
        })->first();

        return $result->id;
    }

    public function findItemByType($type, $items)
    {
        $result = $items->filter(function($item) use ($type) {
            return $item->itemType->name == $type;
        });

        return $result;
    }
}
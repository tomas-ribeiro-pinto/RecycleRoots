<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $recyclePoints = [
            new RecyclePoint([
                'name' => 'High Wycombe recycling centre',
                'address' => 'Clay Lane, Booker, Buckinghamshire, SL7 3DJ',
                'lat' => '51.60488600747863',
                'lng' => '-0.7956837840719871',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/high-wycombe-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Beaconsfield recycling centre',
                'address' => 'A40 London Road, Lower Pyebushes, Buckinghamshire, HP9 2XB',
                'lat' => '51.59804057602368',
                'lng' => '-0.6135969764040702',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/beaconsfield-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Burnham recycling centre',
                'address' => 'Crowpiece Lane, Buckinghamshire, SL2 3TG',
                'lat' => '51.54335853433586',
                'lng' => '-0.6366802989734986',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/burnham-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Amersham recycling centree',
                'address' => 'London Road East, Amersham, HP7 9DT',
                'lat' => '51.65333021208072',
                'lng' => '-0.5846675417214581',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/amersham-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Aston Clinton recycling centre',
                'address' => 'College Road North, Buckinghamshire, HP22 5EZ',
                'lat' => '51.812716434896664',
                'lng' => '-0.7324014324905349',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/aston-clinton/'
            ]),
            new RecyclePoint([
                'name' => 'Aylesbury recycling centre',
                'address' => 'Rabans Close, Aylesbury, HP19 8RS',
                'lat' => '51.825077438666156',
                'lng' => '-0.8504570760962087',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/aylesbury-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Bledlow Ridge recycling centre',
                'address' => 'Wigans Lane, Bledlow Ridge, HP14 4BH',
                'lat' => '51.68851633988863',
                'lng' => '-0.8665020319266178',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/bledlow-ridge-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Chesham recycling centre',
                'address' => 'Latimer Road, Chesham, HP5 1TL',
                'lat' => '51.69056078811511',
                'lng' => '-0.5882834165835442',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/chesham-recycling-centre/'
            ]),
            new RecyclePoint([
                'name' => 'Aylesbury recycling centre',
                'address' => 'Langley Park Road, Langley, SL3 6DD',
                'lat' => '51.510364528216456',
                'lng' => '-0.5417714607741991',
                'managed_by' => 'Buckinghamshire Council',
                'website' => 'https://www.buckinghamshire.gov.uk/waste-and-recycling/household-recycling-centres-permits-and-waste-facilities/find-your-nearest-household-recycling-centre/langley-recycling-centre/'
            ])
        ];

        foreach ($recyclePoints as $recyclePoint) {
            $recyclePoint->save();
        }

        $itemTypes = [
            new ItemType([
                'name' => 'Aerosols',
            ]),
            new ItemType([
                'name' => 'Batteries',
            ]),
            new ItemType([
                'name' => 'Clothing and Textiles',
            ]),
            new ItemType([
                'name' => 'Used Oils',
            ]),
            new ItemType([
                'name' => 'Paint',
            ]),
            new ItemType([
                'name' => 'Furniture',
            ]),
            new ItemType([
                'name' => 'Paper and Cardboard',
            ]),
            new ItemType([
                'name' => 'Electrical Appliances',
            ]),
            new ItemType([
                'name' => 'DIY waste (non-household)',
            ]),
            new ItemType([
                'name' => 'Plastics',
            ]),
            new ItemType([
                'name' => 'Cans',
            ]),
            new ItemType([
                'name' => 'Glass',
            ]),
            new ItemType([
                'name' => 'Garden waste',
            ]),
            new ItemType([
                'name' => 'Food waste',
            ]),
            new ItemType([
                'name' => 'Light bulbs',
            ]),
            new ItemType([
                'name' => 'General waste',
            ]),
            new ItemType([
                'name' => 'Other',
            ]),
        ];

        foreach ($itemTypes as $itemType) {
            $itemType->save();
        }

        $items = [
            new Item([
                'name' => 'Aerosols',
                'item_type_id' => $itemTypes[0]->id,
            ]),
            new Item([
                'name' => 'Batteries',
                'item_type_id' => $itemTypes[1]->id,
            ]),
            new Item([
                'name' => 'Car batteries',
                'item_type_id' => $itemTypes[1]->id,
            ]),
            new Item([
                'name' => 'Carpet',
                'item_type_id' => $itemTypes[2]->id,
            ]),
            new Item([
                'name' => 'Clothes',
                'item_type_id' => $itemTypes[2]->id,
            ]),
            new Item([
                'name' => 'Cooking Oil',
                'item_type_id' => $itemTypes[3]->id,
            ]),
            new Item([
                'name' => 'Waste engine oil',
                'item_type_id' => $itemTypes[3]->id,
            ]),
            new Item([
                'name' => 'Fluorescent tubes',
                'item_type_id' => $itemTypes[14]->id,
            ]),
            new Item([
                'name' => 'LED bulbs',
                'item_type_id' => $itemTypes[14]->id,
            ]),
            new Item([
                'name' => 'Lamp bulbs',
                'item_type_id' => $itemTypes[14]->id,
            ]),
            new Item([
                'name' => 'Furniture',
                'item_type_id' => $itemTypes[5]->id,
            ]),
            new Item([
                'name' => 'Paint (hardened)',
                'item_type_id' => $itemTypes[4]->id,
            ]),
            new Item([
                'name' => 'Garden waste',
                'item_type_id' => $itemTypes[12]->id,
            ]),
            new Item([
                'name' => 'Mattresses',
                'item_type_id' => $itemTypes[2]->id,
            ]),
            new Item([
                'name' => 'General Waste',
                'item_type_id' => $itemTypes[15]->id,
            ]),
            new Item([
                'name' => 'Gas bottles',
                'item_type_id' => $itemTypes[16]->id,
            ]),
            new Item([
                'name' => 'Large Electrical Appliances',
                'item_type_id' => $itemTypes[7]->id,
            ]),
            new Item([
                'name' => 'Small Electrical Appliances',
                'item_type_id' => $itemTypes[7]->id,
            ]),
            new Item([
                'name' => 'Fridges and freezers',
                'item_type_id' => $itemTypes[7]->id,
            ]),
            new Item([
                'name' => 'Cookers',
                'item_type_id' => $itemTypes[7]->id,
            ]),
            new Item([
                'name' => 'Toaster',
                'item_type_id' => $itemTypes[7]->id,
            ]),
            new Item([
                'name' => 'Printer',
                'item_type_id' => $itemTypes[7]->id,
            ]),
            new Item([
                'name' => 'Television',
                'item_type_id' => $itemTypes[7]->id,
            ]),
            new Item([
                'name' => 'Monitors',
                'item_type_id' => $itemTypes[7]->id,
            ]),
            new Item([
                'name' => 'Tiles',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Bricks',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Stones',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Soil',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Turf',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Hardcore and rubble',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Timber',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Bathroom fittings',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Kitchen fittings',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Plumbing and heating',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Roofing materials',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Windows and Doors',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Asbestos',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Plasterboard',
                'item_type_id' => $itemTypes[8]->id,
            ]),
            new Item([
                'name' => 'Plastic Bottles (PET)',
                'item_type_id' => $itemTypes[9]->id,
            ]),
            new Item([
                'name' => 'Plastic Bags and Wrapping',
                'item_type_id' => $itemTypes[9]->id,
            ]),
            new Item([
                'name' => 'Plastic Trays',
                'item_type_id' => $itemTypes[9]->id,
            ]),
            new Item([
                'name' => 'Plastic PVC packaging',
                'item_type_id' => $itemTypes[9]->id,
            ]),
        ];

        foreach ($items as $item) {
            $item->save();
        }

        foreach ($recyclePoints as $recyclePoint)
        {
            $recyclePoint
                ->items()
                ->attach([$items[0]->id,$items[1]->id,$items[2]->id,$items[3]->id,$items[4]->id,$items[5]->id,
                        $items[6]->id,$items[7]->id,$items[10]->id,$items[11]->id,$items[12]->id,$items[13]->id,
                        $items[14]->id, $items[15]->id,$items[16]->id,$items[17]->id,$items[18]->id,$items[19]->id,
                        $items[20]->id,$items[21]->id,$items[22]->id,$items[23]->id,$items[24]->id,$items[25]->id,
                        $items[26]->id,$items[27]->id,$items[28]->id,$items[29]->id,$items[30]->id,$items[31]->id,
                        $items[32]->id,$items[33]->id, $items[34]->id,$items[35]->id,$items[36]->id,$items[37]->id
            ]);
        }
    }
}

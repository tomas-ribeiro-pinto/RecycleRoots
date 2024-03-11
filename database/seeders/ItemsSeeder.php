<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\RecyclePoint;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Seed Items.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("resources/Items.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {

                // Check if the type exists
                $type = ItemType::all()->where('name', $data['1']);

                // If the type does not exist, create it
                if($type->count() == 0)
                {
                    $item = new ItemType([
                        "name" => $data['1'],
                    ]);
                    $item->save();
                    Item::create([
                        "name" => $data['0'],
                        "item_type_id" => $item->id,
                    ]);
                }
                else
                {
                    Item::create([
                        "name" => $data['0'],
                        "item_type_id" => $type->first()->id,
                    ]);
                }
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

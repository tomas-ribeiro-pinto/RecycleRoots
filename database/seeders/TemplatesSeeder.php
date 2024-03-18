<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bin;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\RecyclePoint;
use App\Models\Team;
use App\Models\TeamPostcode;
use App\Models\User;
use Illuminate\Database\Seeder;

class TemplatesSeeder extends Seeder
{
    /**
     * Seed Items.
     */
    public function run(): void
    {
        $bins = [
            $generalBin = new Bin([
                'name' => 'General Waste',
                'dimensions' => 'Up to 240L',
                'color' => 'black',
                'is_template' => 1,
            ]),
            $foodBin = new Bin([
                'name' => 'Food Waste',
                'dimensions' => 'Caddy 23l or 7L',
                'color' => 'yellow',
                'is_template' => 1,
            ]),
            $mixedBin = new Bin([
                'name' => 'Mixed Recycling',
                'dimensions' => '181 to 240L',
                'color' => 'red',
                'is_template' => 1,
            ]),
            $paperBin = new Bin([
                'name' => 'Paper and Cardboard',
                'dimensions' => 'Up to 1100L',
                'color' => 'blue',
                'is_template' => 1,
            ]),
        ];

        foreach ($bins as $bin) {
            $bin->save();
        }

        $generalBin->items()->attach(
            [
                $this->findItem('Animal waste'),
                $this->findItem('Biscuit packaging'),
                $this->findItem('Biscuit packets'),
                $this->findItem('Biscuit wrappers'),
                $this->findItem('Black plastic packaging'),
                $this->findItem('Blister packs'),
                $this->findItem('Bubble wrap'),
                $this->findItem('Buttons'),
                $this->findItem('Cake packets'),
                $this->findItem('Cake wrappers'),
                $this->findItem('Cat litter'),
                $this->findItem('Carrier bags'),
                $this->findItem('Cellophane'),
                $this->findItem('Cereal bags'),
                $this->findItem('Cheese packet'),
                $this->findItem('Cheese wrap'),
                $this->findItem('Cheese wrapping'),
                $this->findItem('Chewing gum wrappers'),
                $this->findItem('Chocolate packet'),
                $this->findItem('Chocolate pouches'),
                $this->findItem('Chocolate wrapper'),
                $this->findItem('Cling film'),
                $this->findItem('Coal ash'),
                $this->findItem('Coffee pods and capsules'),
                $this->findItem('Coffee pouches'),
                $this->findItem('Confectionary wrapper'),
                $this->findItem('Confectionery wrappers'),
                $this->findItem('Corks'),
                $this->findItem('Cosmetic wipes'),
                $this->findItem('Crisp packets'),
                $this->findItem('Disposable cutlery'),
                $this->findItem('Disposable nappies'),
                $this->findItem('Disposable plates and bowls'),
                $this->findItem('Animal bedding'),
                $this->findItem('Crockery'),
                $this->findItem('Drinking glasses'),
                $this->findItem('Cutlery'),
                $this->findItem('Eyeshadow & brow palettes & compacts'),
                $this->findItem('Face and hair mask packaging (single use)'),
                $this->findItem('Film lids'),
                $this->findItem('Fish packet'),
                $this->findItem('Fish wrapping'),
                $this->findItem('Fruit and Vegetable Nets'),
                $this->findItem('Glass cookware'),
                $this->findItem('Granola bags'),
                $this->findItem('Make-up packaging'),
                $this->findItem('Meat packet'),
                $this->findItem('Meat wrapping'),
                $this->findItem('Monster Munch'),
                $this->findItem('Peelable film lids'),
                $this->findItem('Pet bedding'),
                $this->findItem('Pet food pouches'),
                $this->findItem('Pet waste'),
                $this->findItem('Plastic bags and wrapping'),
                $this->findItem('Plastic concealer or eye shadow tubes (inc applicator)'),
                $this->findItem('Plastic Combs'),
                $this->findItem('Plastic Contact Lens Cases'),
                $this->findItem('Plastic eyeliner or concealer pen'),
                $this->findItem('Plastic refill pouches'),
                $this->findItem('Plastic roll-on and stick deodorants'),
                $this->findItem('Plastic sachets, samples and hotel bottle minis'),
                $this->findItem('Plastic mascara tubes (inc brush, wand)'),
                $this->findItem('Plastic Clothes hangers'),
                $this->findItem('Plastic straws'),
                $this->findItem('Polystyrene'),
                $this->findItem('Printer cartridges'),
                $this->findItem('Pyrex'),
                $this->findItem('Saucepans'),
                $this->findItem('Snack packets'),
                $this->findItem('Soft plastics'),
                $this->findItem('Spectacles'),
                $this->findItem('Sticky tape'),
                $this->findItem('Sweet packets'),
                $this->findItem('Sweet wrappers'),
                $this->findItem('Tissues'),
                $this->findItem('Toothbrushes'),
                $this->findItem('Vapes'),
                $this->findItem('Water filters'),
                $this->findItem('Wet wipes'),
                $this->findItem('Wipes packets'),
                $this->findItem('Glasses'),
                $this->findItem('Dry food bags'),
            ]
        );

        $foodBin->items()->attach(
            [
                $this->findItem('Food waste'),
                $this->findItem('Pet food'),
                $this->findItem('Tea bags'),
            ]
        );

        $mixedBin->items()->attach(
            [
                $this->findItem('Aerosols'),
                $this->findItem('Aluminium trays'),
                $this->findItem('Beer bottles'),
                $this->findItem('Biscuit and sweet tins'),
                $this->findItem('Cans'),
                $this->findItem('Cartons'),
                $this->findItem('Drinks cans'),
                $this->findItem('Drinks cartons'),
                $this->findItem('Foil'),
                $this->findItem('Foil trays'),
                $this->findItem('Food and drink cartons'),
                $this->findItem('Food tins and drink cans'),
                $this->findItem('Gift and toy packaging'),
                $this->findItem('Glass bottles and jars'),
                $this->findItem('Glass milk bottles'),
                $this->findItem('Mince pie case'),
                $this->findItem('Nut packets'),
                $this->findItem('Paint tins'),
                $this->findItem('Perfume and aftershave bottles'),
                $this->findItem('Plastic body lotion, hand cream and sunscreen tubes'),
                $this->findItem('Plastic body, hair and face cream pots and tubes'),
                $this->findItem('Plastic bottles'),
                $this->findItem('Plastic drinks bottles'),
                $this->findItem('Plastic dropper bottles'),
                $this->findItem('Plastic lip balm pots'),
                $this->findItem('Plastic lipstick or lip balm tubes'),
                $this->findItem('Plastic make-up tubes'),
                $this->findItem('Plastic milk bottles'),
                $this->findItem('Plastic plant pots'),
                $this->findItem('Plastic pots'),
                $this->findItem('Plastic PVC packaging'),
                $this->findItem('Plastic trays'),
                $this->findItem('Plastic tubes'),
                $this->findItem('Plastic tubs'),
                $this->findItem('Shampoo and conditioner bottles'),
                $this->findItem('Silver foil'),
                $this->findItem('Tetra Packs'),
                $this->findItem('Tin foil'),
                $this->findItem('Wine bottles'),
                $this->findItem('Yoghurt pots'),
            ]
        );

        $paperBin->items()->attach(
            [
                $this->findItem('Birthday cards'),
                $this->findItem('Books'),
                $this->findItem('Cardboard'),
                $this->findItem('Christmas cards'),
                $this->findItem('Envelopes'),
                $this->findItem('Gift wrap'),
                $this->findItem('Greeting cards'),
                $this->findItem('Junk mail'),
                $this->findItem('Magazines'),
                $this->findItem('Newspapers'),
                $this->findItem('Paper'),
                $this->findItem('Paper coffee cups'),
                $this->findItem('Paper towel'),
                $this->findItem('Pizza boxes'),
                $this->findItem('Stamps'),
                $this->findItem('Wallpaper'),
                $this->findItem('Wrapping paper'),
            ]
        );
    }

    public function findItem($name)
    {
        return Item::where('name', $name)->first()->id;
    }

    public function findItemByType($type)
    {
        $items = Item::all();
        $result = $items->filter(function($item) use ($type) {
            return $item->itemType->name == $type;
        });

        return $result;
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bin;
use App\Models\Charity;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\RecyclePoint;
use App\Models\Team;
use App\Models\TeamPostcode;
use App\Models\User;
use Illuminate\Database\Seeder;

class CharitySeeder extends Seeder
{
    /**
     * Seed Charities.
     */
    public function run(): void
    {
        $charities = [
            $charity1 = new Charity([
                'name' => 'Wycombe Food Hub',
                'email' => 'contact@wycombefoodhub.org',
                'website' => 'https://wycombefoodhub.org',
                'phone' => '01494 913626',
                'charity_registration' => 12796053,
                'description' => 'Wycombe Food Hub is a charity that redistributes surplus food to those in need in the High Wycombe area.',
            ]),
            $charity2 = new Charity([
                'name' => 'The Salvation Army',
                'email' => 'HighWycombeShop@satcol.org',
                'website' => 'https://www.salvationarmy.org.uk/clothing-bank',
                'phone' => '01494 442210',
                'charity_registration' => 'N/A',
                'description' => 'The Salvation Army is a charity that provides support to those in need in the High Wycombe area.',
            ]),
            $charity3 = new Charity([
                'name' => 'British Heart Foundation',
                'email' => 'contact@bhf.org.uk',
                'website' => 'https://www.bhf.org.uk',
                'phone' => '07977 271614',
                'charity_registration' => 'N/A',
                'description' => 'The British Heart Foundation is a charity that provides support to those in need in the High Wycombe area.',
            ]),
        ];

        foreach ($charities as $charity) {
            $charity->save();
        }

        $charity1->items()->attach(
            [
                $this->findItem('Food waste'),
                $this->findItem('Pet food'),
                $this->findItem('Tea bags'),
            ]
        );

        $charity2->items()->attach(
            [
                $this->findItem('Clothes'),
                $this->findItem('Clothing and textiles'),
            ]
        );

        $charity3->items()->attach(
            $this->findItemByType('Furniture')
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

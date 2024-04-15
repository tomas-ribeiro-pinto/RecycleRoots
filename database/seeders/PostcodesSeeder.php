<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\RecyclePoint;
use App\Models\Team;
use App\Models\TeamPostcode;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostcodesSeeder extends Seeder
{
    /**
     * Seed Postcodes.
     */
    public function run(): void
    {
        $postcodes = [
            'HP10',
            'HP11',
            'HP12',
            'HP13',
            'HP14',
            'HP15',
            'HP16',
            'HP17',
            'HP18',
            'HP20',
            'HP21',
            'HP22',
            'HP23',
            'HP27',
            'HP4',
            'HP5',
            'HP6',
            'HP7',
            'HP8',
            'HP9',
            'LU6',
            'LU7',
            'MK17',
            'MK18',
            'MK19',
            'NN13',
            'OX6',
            'RG9',
            'SL0',
            'SL1',
            'SL2',
            'SL3',
            'SL4',
            'SL6',
            'SL7',
            'SL8',
            'SL9',
            'UB9',
            'WD3'
        ];

        foreach($postcodes as $postcode)
        {
            $postcode = new TeamPostcode([
                'postcode' => $postcode,
                'team_id' => 1,
            ]);
            $postcode->save();
        }
    }
}

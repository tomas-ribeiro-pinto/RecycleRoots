<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Post;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Seed Blog articles.
     */
    public function run(): void
    {
        $c1 = Category::create([
            'id' => 1,
            'name' => 'Recycling',
            'slug' => 'recycling',
        ]);
        $c1->save();

        $c2 = Category::create([
            'id' => 2,
            'name' => 'Sustainability',
            'slug' => 'sustainability',
        ]);
        $c2->save();

        $c3 = Category::create([
            'id' => 3,
            'name' => 'Reusing',
            'slug' => 'reusing',
        ]);
        $c3->save();

        $c4 = Category::create([
            'id' => 4,
            'name' => 'Summer',
            'slug' => 'summer',
        ]);
        $c4->save();

        $c5 = Category::create([
            'id' => 5,
            'name' => 'Garden',
            'slug' => 'garden',
        ]);
        $c5->save();

        $article1 = Post::factory()->create();
        $article2 = Post::factory()->create();
        $article3 = Post::factory()->create();
        $article4 = Post::factory()->create();
        $article5 = Post::factory()->create();
        $article6 = Post::factory()->create();
        $article7 = Post::factory()->create();
        $article8 = Post::factory()->create();

        $article1->categories()->attach(4);
        $article2->categories()->attach(5);
        $article3->categories()->attach(5);
        $article4->categories()->attach(1);
        $article5->categories()->attach(2);
        $article6->categories()->attach(3);
        $article7->categories()->attach([1, 5]);
        $article8->categories()->attach([1, 4]);


        $article1->items()->attach(
            [
                $this->findItem('Aerosols'),
            ]
        );

        $article2->items()->attach(
            $this->findItemByType('Plastic')
        );

        $article3->items()->attach(
            $this->findItemByType('Clothing and Textiles')
        );

        $article4->items()->attach(
            $this->findItemByType('Bathroom Suites')
        );

        $article5->items()->attach(
            $this->findItemByType('Paper and Cardboard')
        );

        $article7->items()->attach(
            $this->findItemByType('Wood and Timber')
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

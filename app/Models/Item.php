<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function recyclePoints()
    {
        return $this->belongsToMany(RecyclePoint::class);
    }

    public function itemType()
    {
        return $this->belongsTo(ItemType::class);
    }

    public function charities()
    {
        return $this->belongsToMany(Charity::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}

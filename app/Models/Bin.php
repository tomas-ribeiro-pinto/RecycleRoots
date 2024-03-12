<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function binLocations()
    {
        return $this->hasMany(BinLocation::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }
}

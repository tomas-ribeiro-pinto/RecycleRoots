<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinException extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function binLocation()
    {
        return $this->belongsTo(BinLocation::class);
    }
}

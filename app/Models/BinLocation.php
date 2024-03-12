<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinLocation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function binExceptions()
    {
        return $this->hasMany(BinException::class);
    }

    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }

    public function teamPostcode()
    {
        return $this->belongsTo(TeamPostcode::class);
    }
}

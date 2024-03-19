<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinLocation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function exceptions()
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

    // Returns an array of items and exceptions for this bin location
    public function getItems()
    {
        $binExceptions = $this->exceptions;
        $binItems = $this->bin->items->sortBy('name');
        $binItemsWithExceptions = [];
        foreach($binItems as $item)
        {
            $binItemsWithExceptions[$item->id] = [
                'item' => $item,
                'exception' => null
            ];
        }
        if($binExceptions != null)
        {
            foreach($binExceptions as $exception)
            {
                $binItemsWithExceptions[$exception['item_id']] = [
                    'item' => Item::find($exception['item_id']),
                    'exception' => $exception['exception_rule']
                ];
            }
        }

        $binItemsWithExceptions = array_filter($binItemsWithExceptions, function($item) {
            return $item['exception'] != 'remove';
        });

        return $binItemsWithExceptions;
    }

    public function searchAcceptedItem($item)
    {
        $items = $this->getItems();

        foreach($items as $binItem)
        {
            if($binItem['item']->name == $item->name)
            {
                return true;
            }
        }

        return false;
    }
}

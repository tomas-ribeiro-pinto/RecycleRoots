<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Post extends Model
{

    protected $guarded = [];

    protected $casts = [
        'body' => AsRichTextContent::class,
    ];

//    protected function body(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => $value->body->render(),
//        );
//    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'category_id', 'item_image', 'item_image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function docs()
    {
        return $this->hasMany(Document::class);
    }
}

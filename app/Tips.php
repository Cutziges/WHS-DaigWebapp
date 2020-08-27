<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    protected $fillable = [
        'category_id', 'shortTip', 'longTip',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

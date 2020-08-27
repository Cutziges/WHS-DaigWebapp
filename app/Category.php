<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'id',
    ];


    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function tips()
    {
        return $this->hasMany(Tips::class);
    }
}

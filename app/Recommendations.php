<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendations extends Model
{
    protected $fillable = [
       'name', 'description', 'topic_id', 'address', 'address_long', 'address_lat',
        'place_image', 'place_image_path', 'website', 'phone', 'distance',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}

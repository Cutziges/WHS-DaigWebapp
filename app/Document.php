<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title', 'file', 'file_path', 'item_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

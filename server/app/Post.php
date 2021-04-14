<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = [
        'post_date'
    ];

    public function primaryCategory()
    {
        return $this->belongsTo(PrimaryCategory::class);
    }
}

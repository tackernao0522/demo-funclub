<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BigImage extends Model
{
    protected $fillable = [
        'info_big_image_name',
        'description',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class SubTitle extends Model
{
    protected $fillable = [
        'id',
        'sub_title',
        'description',
    ];

    // public function posts(): HasMany
    // {
    //     return $this->hasMany('App\Post');
    // }
}

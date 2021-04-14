<?php

namespace App;

use App\SubTitle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    protected $dates = [
        'post_date'
    ];

    public function primaryCategory()
    {
        return $this->belongsTo(PrimaryCategory::class);
    }

    public function subTitle()
    {
        return $this->hasOne(SubTitle::class);
    }
}

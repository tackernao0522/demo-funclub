<?php

namespace App;

use App\SubTitle;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Post extends Model
{

    protected $fillable = [
        'post_date',
        'body',
        'primary_category_id',
        'post_image_name',
    ];

    public function primaryCategory(): BelongsTo
    {
        return $this->belongsTo('App\PrimaryCategory');
    }

    // public function subTitle(): BelongsTo
    // {
    //     return $this->belongsTo('App\SubTitle');
    // }

    /**
     * 整形した期限日
     * @return string
     */
    public function getFormattedPostDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['post_date'])
            ->format('n/d');
    }

    public function getFormattedPostYearAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['post_date'])
            ->format('Y');
    }
}

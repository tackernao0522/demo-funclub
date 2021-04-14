<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubTitle extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

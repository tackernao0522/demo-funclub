<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\BlogPostCategory;

class BlogPost extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(BlogPostCategory::class, 'category_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryEcCategory extends Model
{
    public function secondaryEcCategories()
    {
        return $this->hasMany(SecondaryEcCategory::class);
    }
}

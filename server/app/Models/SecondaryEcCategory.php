<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondaryEcCategory extends Model
{
    public function primaryEcCategory()
    {
        return $this->belongsTo(PrimaryEcCategory::class);
    }
}

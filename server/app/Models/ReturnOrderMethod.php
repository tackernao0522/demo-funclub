<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnOrderMethod extends Model
{
    protected $fillable = [
        'return_order_method_name',
        'sort_no',
    ];
}

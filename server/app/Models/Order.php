<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function returnOrderProductMethod()
    {
        return $this->belongsTo(ReturnOrderMethod::class, 'return_order_method_name_id', 'id');
    }
}

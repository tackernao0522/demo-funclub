<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'item_id', 'quantity'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payer()
    {
        return $this->belongsTo(ShippingFeePayer::class, 'shipping_fee_payer_id');
    }

    public function secondaryEcCategory()
    {
        return $this->belongsTo(SecondaryEcCategory::class, 'secondary_ec_category_id');
    }

    public function condition()
    {
        return $this->belongsTo(ItemCondition::class, 'item_condition_id');
    }
}

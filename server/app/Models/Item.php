<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Item extends Model
{
    // 販売中
    const STATE_SELLING = 'selling';
    // 売り切れ
    const STATE_BOUGHT = 'bought';

    public function secondaryEcCategory()
    {
        return $this->belongsTo(SecondaryEcCategory::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function condition()
    {
        return $this->belongsTo(ItemCondition::class, 'item_condition_id');
    }

    public function payer()
    {
        return $this->belongsTo(ShippingFeePayer::class, 'shipping_fee_payer_id');
    }

    public function delivery()
    {
        return $this->belongsTo(DeliveryMethod::class, 'delivery_method_id');
    }

    public function deliveryTime()
    {
        return $this->belongsTo(DeliveryTime::class, 'delivery_time_id');
    }

    public function getIsStateSellingAttribute()
    {
        return $this->state === self::STATE_SELLING;
    }
}

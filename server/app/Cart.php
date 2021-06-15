<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;


    public function __construct($oldCart)
    {

        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $item_id)
    {

        $storedItem = [
            'qty' => 0, 'item_id' => 0, 'item_name' => $item->name,
            'delivery_time_id' => $item->deliveryTime->name,
            'item_price' => $item->price, 'item_image_name' => $item->item_image_name, 'item' => $item
        ];

        if ($this->items) {
            if (array_key_exists($item_id, $this->items)) {
                $storedItem = $this->items[$item_id];
            }
        }

        $storedItem['qty']++;
        $storedItem['item_id'] = $item_id;
        $storedItem['item_name'] = $item->name;
        $storedItem['item_price'] = $item->price;
        $storedItem['item_image_name'] = $item->item_image_name;
        $storedItem['delivery_time_id'] = $item->deliveryTime->name;
        $this->totalQty++;
        $this->totalPrice += $item->price;
        $this->items[$item_id] = $storedItem;
    }

    public function updateQty($id, $qty)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['item_price'] * $this->items[$id]['qty'];
        $this->items[$id]['qty'] = $qty;
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['item_price'] * $qty;
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['item_price'] * $this->items[$id]['qty'];
        unset($this->items[$id]);
    }
}

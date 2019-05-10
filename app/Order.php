<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function plates()
    {
        return $this->belongsToMany(Plate::class)->withPivot('quantity', 'status');;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'status');
    }
    public static function renderRows($orders)
    {
        $a = array();
        foreach ($orders as $order) {
            $a[] = view('orders.layouts.tableRow', compact('order'))->render();
        }
        return $a;
    }
}

<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    
    public function plates()
    {
        return $this->belongsToMany(Plate::class);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    
    public static function renderRows($menus)
    {
        $a = array();
        foreach ($menus as $menu) {
            $a[] = view('menus.layouts.tableRow', compact('menu'))->render();
        }
        return $a;
    }
}

<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    


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

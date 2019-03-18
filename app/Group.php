<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
    public function plates()
    {
        return $this->belongsToMany(Plate::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}

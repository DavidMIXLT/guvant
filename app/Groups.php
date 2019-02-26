<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    //
    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

}

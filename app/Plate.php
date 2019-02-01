<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;
use AlaCartaYa\Product;
class Plate extends Model
{
    //

    public function validate($request)
    {
        $request->validate([
            'Name' => 'required',
            'Description' => 'required',
            'Stock' => 'required|integer',
        ]);
    }


    public function products(){
        return $this->belongsToMany(Product::class);
    }
}

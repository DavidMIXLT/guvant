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
            'name' => 'required|max:191',
            'description' => 'required|max:191',
            'ListProducts.*' => 'required|integer',
        ]);
    }


    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public static function renderRows($plates)
    {
        $a = array();
        foreach ($plates as $plate) {
            $a[] = view('plates.layouts.tablerow', compact('plate'))->render();
        }
        return $a;
    }
    public function menu()
    {
        return $this->belongsToMany(Menu::class);
    }
}

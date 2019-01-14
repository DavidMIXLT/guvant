<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    public function validate($request){
        $request->validate([
            'Name' => 'required',
            'Description' => 'required',
            'Stock' => 'required|integer',
        ]);
    }

}

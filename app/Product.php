<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['Name','Description','Stock'];

    /**
     * Valida el producto
     *
     * @param  int  $request
     *
     */
    public function validate($request)
    {
        $request->validate([
            'Name' => 'required',
            'Description' => 'required',
            'Stock' => 'required|integer',
        ]);
    }


}

<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    public function validate($request)
    {
        $request->validate([
            'name' => 'required',
        ]);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['name','description','stock'];

    /**
     * Valida el producto
     *
     * @param  int  $request
     *
     */
    public function validate($request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required|integer',
        ]);

        
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


}

<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;
use AlaCartaYa\Pagination;

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


    public function filter($decode,$request)
    {
        $column = 'id';
        $order = "ASC";

        if (isset($decode['mode'])) {
            $column = $decode['mode'];
        }

        if (isset($decode['order'])) {
            $order = $decode['order'];
        }
        if (isset($decode['selectedCategories'])) {
            if (count($decode['selectedCategories']) > 0) {
                $categories = Category::whereIn('name', $decode['selectedCategories'])->get()->pluck('id')->toArray();
                foreach ($categories as $id) {
                    $query = Product::whereHas('categories', function ($q) use ($id) {
                        $q->where('category_id', $id);
                    })->orderBy($column, $order)->paginate(Pagination::getNumberofItems($request));

                }
            } else {
                $query = Product::orderBy($column, $order)->paginate(Pagination::getNumberofItems($request));
            }
        } else {
            $query = Product::orderBy($column, $order)->paginate(Pagination::getNumberofItems($request));
        }

        return $query;
    }

    
    public static function renderRows($categories)
    {
        $a = array();
        foreach ($categories as $category) {
            $a[] = view("categories.layouts.tableRow", compact('category'))->render();
        }
        return $a;
    }
    


}

<?php

namespace AlaCartaYa;

use Illuminate\Database\Eloquent\Model;

class Pagination extends Model
{
    public static function getNumberofItems($request)
    {
        if ($request->session()->has('NumberOfItems')) {
            return $request->session()->get('NumberOfItems');
        } else {
            return 5;
        }
    }

 /*   public function getPaginationLinkHTML($object,$request)
    {
        $NumberOfItems = 5;
        $object = $object->paginate(Pagination::getNumberofItems($request));
        $paginationHTML = view('layouts.pagination', compact('object'))->render();
        
        return $paginationHTML;

    }*/
}

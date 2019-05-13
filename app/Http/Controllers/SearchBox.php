<?php

namespace AlaCartaYa\Http\Controllers;

use Illuminate\Http\Request;
use AlaCartaYa\Menu;
use AlaCartaYa\Plate;
use AlaCartaYa\Product;
class SearchBox extends Controller
{
    //
    public function Search(Request $request){

        $products = Product::where('name','LIKE','%'.$request->search.'%')->orWhere ( 'description', 'LIKE', '%' . $request->search . '%' )->get();
        $plates = Plate::where('name','LIKE','%'.$request->search.'%')->orWhere ( 'description', 'LIKE', '%' . $request->search . '%' )->get();
        $menus = Menu::where('name','LIKE','%'.$request->search.'%');
        
        return view('searchBox.index',['products' => $products,'plates' => $plates,'search' => $request->search,'menu' => $menus]);
    }
}

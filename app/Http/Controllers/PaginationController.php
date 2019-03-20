<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Category;
use AlaCartaYa\Product;
use Illuminate\Http\Request;

class PaginationController extends Controller
{
    /**
     * Funcion utiliza para guardar en la session del usuario el numero de Items que quiere
     * que se muestren en las tablas de la aplicacion
     * @param Request
     */
    public function setNumberOfItems(Request $request)
    {
        $request->session()->put('NumberOfItems', $request->NumberOfItems);

        return response()->json([
            "message" => $request->NumberOfItems,
        ], 200);
    }

    /**
     * Funcion utilizada para filtrar por categoria
     * @param $request
     */
    public function filter(Request $request)
    {
        if ($request->ajax()) {
            
            $decode = json_decode($request->getContent(), true);
            $Category = new Category();
//----------------------------------------------------------------------------\\
/**
 * Switch  utilizado para seleccionar que Modelo hay que filtrar por categoria
 */
            switch ("product") {
                case "product":
                    $object = $Category->filter($decode, $request);
                    $html = Product::renderRows($object);
                    $paginationHTML = view('layouts.pagination', compact('object'))->render();
                    break;
            }
//----------------------------------------------------------------------------\\
/**
 * RETURN
 */
            return response()->json([
                'html' => $html,
                'paginationHTML' => $paginationHTML,
            ], 200);

        }
    }

/*    public function getPaginationLinks(Request $request)
{
$pagination = new Pagination();
$product = new Product();
$paginationHTML = $pagination->getPaginationLinkHTML($product,$request);
if ($request->ajax()) {
return response()->json([
'paginationHTML' => $paginationHTML,
], 200);
}

}*/

}

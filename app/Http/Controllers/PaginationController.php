<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Category;
use AlaCartaYa\Product;
use Illuminate\Http\Request;

class PaginationController extends Controller
{

    public function setNumberOfItems(Request $request)
    {
        $request->session()->put('NumberOfItems', $request->NumberOfItems);
        return response()->json([
            "message" => $request->NumberOfItems,
        ], 200);
    }

    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $decode = json_decode($request->getContent(), true);
            $Category = new Category();
            switch ("product") {
                case "product":
                    $object = $Category->filter($decode, $request);
                    $html = Product::renderRows($object);
                    $paginationHTML = view('layouts.pagination', compact('object'))->render();
                    break;
            }

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

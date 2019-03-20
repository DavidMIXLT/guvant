<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Pagination;
use AlaCartaYa\Plate;
use AlaCartaYa\Product;
use Illuminate\Http\Request;

class PlateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index(Request $request)
    {
//----------------------------------------------------------------------------\\
/**
 * Generamos el paginate
 */
        $plates = Plate::paginate(Pagination::getNumberofItems($request));
//----------------------------------------------------------------------------\\
        if ($request->ajax()) {
            /**
             * Se renderizan las filas de la tabla y se renderiza tambien el pagination
             */
            $html = Plate::renderRows($plates);
            
            $paginationHTML = view('layouts.pagination', ['object' => $plates])->render();
//----------------------------------------------------------------------------\\
            /**
             * RETURN
             */
            return response()->json([
                'html' => $html,
                'paginationHTML' => $paginationHTML,
                'items' => $plates,

            ], 200);
        } else {
            /**
             * RETURN
             */
            return view('plates.index', compact('plates'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        $view = view('plates.create', compact('products'))->render();
        return response()->json([
            'status' => 'success',
            'html' => $view,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $ProductList = explode(",", $request->ProductList);
        $products = Product::find($ProductList);
        $plate = new Plate;
        $plate->validate($request);
        $plate->name = $request->name;
        $plate->description = $request->description;
        $plate->save();

        $plate->products()->attach($products);

        $view = view('plates.layouts.tableRow', compact('plate'))->render();
        return response()->json([
            'status' => 'success',
            'message' => __('messages.successfullyCreated', ["Object" => $plate->name]),
            'html' => $view,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plate $plate)
    {
        $view = view('plates.show', compact('plate'))->render();
        return response()->json([
            'status' => 'success',
            'html' => $view,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $Request, $id)
    {

        $SelectedProducts = Plate::findOrFail($id);
        $ids = array();
        foreach ($SelectedProducts->products as $product) {
            $ids[] = $product->id;
        }

        $products = Product::whereNotIn('id', $ids)->get();

        $view = view('plates.edit', compact('products', 'SelectedProducts'))->render();
        return response()->json([
            'status' => 'success',
            'html' => $view,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ProductList = explode(",", $request->ProductList);
        $products = Product::findOrFail($ProductList);
        $plate = Plate::findOrFail($id);

        $plate->validate($request);
        $plate->name = $request->name;
        $plate->description = $request->description;
        $plate->save();

        $plate->products()->sync($products);
        $view = view('plates.layouts.tableRow', compact('plate'))->render();
        return response()->json([
            'status' => 'success',
            'message' => __("messages.successfullyUpdate", ["Object" => $plate->name]),
            'html' => $view,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($id == -1) {
            $decode = json_decode($request->getContent(), true);
            Plate::destroy($decode['listofid']);

        } else {
            Plate::destroy($id);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('messages.deleted'),

        ]);
    }
}

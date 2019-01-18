<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Product;
use Illuminate\Http\Request;

/*
TO DO

Añadir listado de errores / mensaje cuando los productos son eliminados

 */
class ProductController extends Controller
{



    public function printIncomingProductOrders(){
        $products = Product::all();

        return view('productsViews.incomingOrders',compact('products'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('productsViews.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('productsViews.createProducts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Metodo llamado cuando se envia por POST se crea un nuevo producto y luego es guardado en la base de datos

        $product = new Product;
        //Se valida el producto
        $product->validate($request);

        //Se crea el producto y se guarda en la base de datos

        $product->name = ($request->Name);
        $product->description = ($request->Description);
        $product->stock = ($request->Stock);
        $alertaCreado = $product->save();

        //Si no se a podido crear el producto en la base de datos se aborta y se redirige el usuario a la pagina de error
        if (!$alertaCreado) {
            App::abort(500, 'Error');
        }

        $products = Product::all();
        return view('productsViews.products', compact('products', 'alertaCreado'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "SHOW";
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id',$id)->first();
        return view('productsViews.editProducts',compact('product'));
        //
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
        $product = Product::find($id);
        //Se valida el producto
        $product->validate($request);

        //Se crea el producto y se guarda en la base de datos
        
        $product->name = ($request->Name);
        $product->description = ($request->Description);
        $product->stock = ($request->Stock);
        $alertaCreado = $product->save();
        $products = Product::all();
        return view('productsViews.products', compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
        $alertaBorrado;

        //Borramos el producto que pasen por el $id
        if (isset($request->productsToDelete)) {
            $ids = explode(' ', $request->productsToDelete);

            $alertaBorrado = Product::destroy(collect($ids));
            $products = Product::all();
        
        } else {
            $alertaBorrado = Product::destroy($id);
            $products = Product::all();
        
        }

        $products = Product::all();
        return view('productsViews.products', compact('products'));

    }


   
}

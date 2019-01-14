<?php

namespace AlaCartaYa\Http\Controllers;

use Illuminate\Http\Request;
use AlaCartaYa\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('createProducts');
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
        $alertaCreado =  $product->save();
        
        //Si no se a podido crear el producto en la base de datos se aborta y se redirige el usuario a la pagina de error
         if(!$alertaCreado){
            App::abort(500,'Error');
         }

         $products = Product::all();     
         return view('products',compact('products','alertaCreado'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

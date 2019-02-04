<?php

namespace AlaCartaYa\Http\Controllers;

use Illuminate\Http\Request;
use AlaCartaYa\Product;
use AlaCartaYa\Plate;
class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plates = Plate::all();
        return view('platesViews.index',compact('plates'));
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
        $view = view('platesViews.create',compact('products'))->render();
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
        $ProductList = explode(",",$request->ProductList);
        $products = Product::find($ProductList);
        $plate = new Plate;
        $plate->validate($request);
        $plate->name = $request->name;
        $plate->description = $request->description;
        $plate->save();

        $plate->products()->attach($products );

        $view = view('platesViews.layouts.tableRow',compact('plate'))->render();
        return response()->json([
            'status' => 'success',
            'html' => $view
        ]);
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

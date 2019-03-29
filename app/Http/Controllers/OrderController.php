<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function getMenuModal($id, Request $request)
    {
        $menu = Menu::find($id);
        $id = $request->session()->get('AccordionId', 1);
        $id++;
        $request->session()->put('AccordionId', $id);
        $html = view('orders.layouts.addMenu', ['id' => "modalAddMenu", 'menu' => $menu, 'id' => $request->session()->get('AccordionId', 1)])->render();
        return response()->json([
            'html' => $html,
            'message' => "hola",
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if ($request->ajax()) {

            //$paginationHTML = view('layouts.pagination', ['object' => $menus])->render();
            return response()->json([
                'html' => null,
                'paginationHTML' => null,

            ], 200);

        } else {

            return view("orders.index");
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $menus = Menu::all();
            $request->session()->put('AccordionId', 0);
            $view = view('orders.create', compact('menus'))->render();

            return response()->json([
                'status' => 'success',
                'html' => $view,

            ]);
        }

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
        return "hola";
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

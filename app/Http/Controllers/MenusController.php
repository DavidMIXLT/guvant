<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Menu;
use AlaCartaYa\Pagination;
use Illuminate\Http\Request;

class MenusController extends Controller
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
        //
        $NumberOfItems = Pagination::getNumberofItems($request);
        $menus = Menu::paginate($NumberOfItems);
        if ($request->ajax()) {

            $a = Menu::renderRows($menus);
            $paginationHTML = view('layouts.pagination', ['object' => $menus])->render();
            return response()->json([
                'html' => $a,
                'paginationHTML' => $paginationHTML,

            ], 200);

        } else {

            return view('menus.index', compact('menus'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if ($request->ajax()) {

            $view = view('menus.create', compact('products'))->render();
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

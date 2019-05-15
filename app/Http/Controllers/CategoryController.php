<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Category;
use AlaCartaYa\Pagination;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $NumberOfItems = Pagination::getNumberofItems($request);
        $categories = Category::paginate($NumberOfItems);

        if ($request->ajax()) {
            $a = Category::renderRows($categories);
            $paginationHTML = view('layouts.pagination', ['object' => $categories])->render();
            return response()->json([
                'html' => $a,
                'paginationHTML' => $paginationHTML,

            ], 200);
        } else {
        
            return view("categories.index", compact("categories"));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('categories.create')->render();
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
        $category = new Category();
        $category->validate($request);

        $category->fill($request->all())->save();
        $view = view("categories.layouts.tableRow", compact("category"))->render();
        return response()->json([
            "status" => "success",
            'html' => $view,
            'message' => __('messages.successfullyCreated', ["Object" => $category->name]),
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
        Category::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.deleted'),

        ]);
    }
}

<?php

namespace AlaCartaYa\Http\Controllers;
use AlaCartaYa\Pagination;
use AlaCartaYa\Menu;
use AlaCartaYa\Order;
use AlaCartaYa\Plate;
use AlaCartaYa\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function getProductsModal()
    {

        $html = view('orders.layouts.addProduct', ["id" => "ModalAddProducts"])->render();
        return response()->json([
            'html' => $html,
            'message' => "hola",
        ], 200);
    }
    public function getPlatesModal()
    {
        $html = view('orders.layouts.addPlate', ["id" => "ModalAddPlate"])->render();
        return response()->json([
            'html' => $html,
            'message' => "hola",
        ], 200);
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
        $orders = Order::paginate(Pagination::getNumberofItems($request));
        if ($request->ajax()) {

              $html = Order::renderRows($orders); 
            $paginationHTML = view('layouts.pagination', ['object' => $orders])->render();
            return response()->json([
                'html' => $html,
                'paginationHTML' => $paginationHTML,

            ], 200);

        } else {
        
         
            return view("orders.index",['orders' => $orders]);
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
        $decode = $request->json()->all();
        $Order = new Order();
        $Order->name = $decode['name'];
        $Order->save();

        foreach ($decode['products'] as $key => $value) {
            $product = Product::find($value['id']);
            $Order->products()->save($product, array('quantity' => $value['quantity']));
        }
        foreach ($decode['plates'] as $key => $value) {
            $plate = Plate::find($value['id']);
            $Order->plates()->save($plate, array('quantity' => $value['quantity']));
        }

        $view = view('orders.layouts.tableRow',['order' => $Order])->render();
        return response()->json([
            'message' => __("messages.successfullyCreated", ['Object' => $Order->name]),
            'html' => $view,

        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        
        $view = view('orders.show', compact('order'))->render();
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
        Order::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.deleted'),

        ]);
    }
}

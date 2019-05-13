<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Menu;
use AlaCartaYa\Order;
use AlaCartaYa\Pagination;
use AlaCartaYa\Plate;
use AlaCartaYa\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function completeOrder($id)
    {
        $order = Order::find($id);

        $order->status = 2;
        $order->save();

        DB::table('orderStatus')->truncate();
        DB::table('orderStatus')->insert(
            ['globalStatus' => $order->name . $order->status]
        );
        
        return response()->json([
            'update' => $order->name . $order->status,

        ], 200);
    }
    public function getLastOrder()
    {

        $status = DB::table('orderStatus')->first();

        if (!is_null($status)) {
            return response()->json([
                'update' => $status->globalStatus,
            ], 200);
        } else {
            return response()->json([
                'error' => "No object",
            ], 200);
        }

    }
    public function accept($id)
    {
        $order = Order::find($id);

        $order->status = 1;
        $order->save();

        DB::table('orderStatus')->truncate();
        DB::table('orderStatus')->insert(
            ['globalStatus' => $order->name . $order->status]
        );
        $view = Order::renderRows(Order::all());

        return response()->json([
            'html' => $view,
            'update' => $order->name . $order->status,

        ], 200);
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

            $status = DB::table('orderStatus')->first();
            return view("orders.index", ['orders' => $orders, 'lastOrder' => $status->globalStatus]);
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
        $Order->status = 0;
        $Order->save();

        foreach ($decode['products'] as $key => $value) {
            $product = Product::find($value['id']);
            $Order->products()->save($product, array('quantity' => $value['quantity']));
        }
        foreach ($decode['plates'] as $key => $value) {
            $plate = Plate::find($value['id']);
            $Order->plates()->save($plate, array('quantity' => $value['quantity']));
        }

        $view = view('orders.layouts.tableRow', ['order' => $Order])->render();

        DB::table('orderStatus')->truncate();
        DB::table('orderStatus')->insert(
            ['globalStatus' => $Order->name . $Order->status]
        );

        return response()->json([
            'message' => __("messages.successfullyCreated", ['Object' => $Order->name]),
            'html' => $view,
            'update' => $Order->name . $Order->status,

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
        $order = Order::find($id);

        DB::table('orderStatus')->truncate();
        DB::table('orderStatus')->insert(
            ['globalStatus' => $order->name . 5]);

        $name = $order->name;
        Order::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.successfullyDeleted', ['Object' => $name]),
            'update' => $order->name . 5,

        ]);
    }
}

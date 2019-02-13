<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Category;
use AlaCartaYa\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
TO DO

Añadir listado de errores / mensaje cuando los productos son eliminados

 */
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function printIncomingProductOrders()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products.incomingOrders', compact('products', 'categories'));
    }

    public function massiveElimination(Request $request){
     
        Product::destroy($request->input('ListOfID'));
     
        return response()->json([
            'status' => 'success',
            'message' => $request->input('ListOfID'),

        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page') - 1;
        $products = Product::all();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {

            $product = new Product;
            $categories = Category::all();
            $view = view('products.create', compact('product', 'categories'))->render();
            return response()->json([
                'status' => 'success',
                'html' => $view,

            ]);

        } else {
            return redirect()->route('products.index');
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
        //Metodo llamado cuando se envia por POST se crea un nuevo producto y luego es guardado en la base de datos
        $product = new Product;
        //Se valida el producto
        $product->validate($request);
        //Se crea el producto y se guarda en la base de datos
        $product->fill($request->all())->save();
        $category = Category::find(explode(",", $request->CategoryList));
        $product->categories()->attach($category);

        $categories = $product->categories;
        $view =  view('products.layouts.tableRow', compact('product','categories'))->render();
        return response()->json([
            'status' => 'success',
            'message' => __("messages.successfullyCreated", ['Object' => $product->Name]),
            'html' => $view,

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
        $product = Product::findOrFail($id);
        $ids = array();
        foreach ($product->categories as $category) {
            $ids[] = $category->id;
        }
        $SelectedCategories = $product->categories;
        $categories = Category::whereNotIn('id', $ids)->get();
        $view = view('products.edit', compact('product', 'categories', 'SelectedCategories'))->render();
        return response()->json([
            'status' => 'success',
            'html' => $view,
            'message' => $ids,

        ]);

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //TO DO: Crear un propio metodo para actualizar el stock para evitar errores i solo actualizar la columna correspondiente
    public function update(Request $request, $id)
    {
        /*
        Si en el request nos envian la variable  stockActualizar significa que nos estan enviado mas de un producto a actualizar
         */
        if ($id != "mul") {
            $product = Product::find($id);
            //Se valida el producto

            $product->validate($request);

            //Se crea el producto y se guarda en la base de datos

            $product->name = ($request->Name);
            $product->description = ($request->Description);
            $product->stock = ($request->Stock);
            $categories = Category::find(explode(",", $request->CategoryList));
            $product->categories()->sync($categories);
            $categories = $product->categories;
            $view =  view('products.layouts.tableRow', compact('product','categories'))->render();
            $alertaCreado = $product->save();
            return response()->json([
                "status" => "success",
                "message" => __('messages.successfullyUpdate', ["Object" => $product->name]),
                'html' => $view,

            ]);

        } else {

            //Comprovamos que no nos envien una string vacia
            if ($request->input("stockActualizar") != null) {
                $ids = explode(" ", $request->input("stockActualizar"));
                foreach ($ids as $product) {
                    $separatedIdandStock = explode(":", $product);
                    //Id 0 para el id del producto y el 1 para el nuevo stock

                    if (is_numeric($separatedIdandStock[1])) {
                        $product = Product::find($separatedIdandStock[0]);
                        //Se valida el producto
                        $product->stock = $separatedIdandStock[1];
                        $product->save();
                    }

                }
            }

        }
        $products = Product::all();
        return view('products.products', compact('products'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {   
        Product::destroy($id);
        return response()->json([
            'status' => 'success',
           'message' => __('messages.successfullyDeleted', ["Object" => "Products"]),
        ]);

    }

    public function filterCategory($category){

        $categoryCheck = Category::where('name','=', $category)->get(['id'])->pluck('id');
        if($categoryCheck != null){
            
            $products = Product::whereHas('categories',function($query) use($categoryCheck){

                $query->whereIn('category_id',$categoryCheck);
            })->get();
            $view = [];
            foreach ($products as $product) {
               $view[] = view('products.layouts.tableRow', compact('product'))->render();
            }
            return $view;

        }else{
            return response()->json([
                'status' => 'fail',
            ]);
        }
    }

}

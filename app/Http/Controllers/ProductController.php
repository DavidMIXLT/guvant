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

    public function printIncomingProductOrders()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products.incomingOrders', compact('products', 'categories'));
    }

    public function massiveElimination(Request $request)
    {
        $decode = json_decode($request->getContent(), true);
        Product::destroy($decode['listofid']);

        return response()->json([
        
            'message' => __('messages.deleted'),

        ],200);
    }

    public function getPaginationLinks(Request $request)
    {
        $object = Product::paginate(5);
        $paginationHTML = view('layouts.pagination', compact('object'))->render();
        if ($request->ajax()) {
            return response()->json([
                'paginationHTML' => $paginationHTML,
                'test' => "hola",
            ],200);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            //$t = $category->pluck('id')->toArray();
            /*    $products = Product::whereHas('categories', function ($query) use ($t) {
            $query->whereIn('category_id', $t);
            })->get();*/

            $products = Product::paginate(5);
            $a = array();
            foreach ($products as $product) {
                $categories = $product->categories;
                $a[] = view('products.layouts.tableRow', compact('product', 'categories'))->render();
            }
            $object = $products;
            $paginationHTML = view('layouts.pagination', compact('object'))->render();
            return response()->json([
                'html' => $a,
                'paginationHTML' => $paginationHTML,
              

            ],200);

        } else {
            $category = Category::all();
            $products = Product::paginate(5);
            $categories = Category::all();
            return view('products.index', compact('products', 'categories'));
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

            $product = new Product;
            $categories = Category::all();
            $view = view('products.create', compact('product', 'categories'))->render();
            return response()->json([
                'html' => $view,

            ],200);

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
        $a = $product->Name;
        $view = view('products.layouts.tableRow', compact('product', 'categories'))->render();
        return response()->json([
            'message' => __("messages.successfullyCreated", ['Object' => $product->name]),
            'html' => $view,

        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        if($request->ajax()){
            $product = Product::find($id);
            $categories = $product->categories;
            $a = $product->Name;
            $view = view('products.layouts.tableRow', compact('product', 'categories'))->render();
            return response()->json([
                'html' => $view,
    
            ],200);
        }else {
            return redirect()->route('products.index');
        }
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
            'html' => $view,
            'message' => $ids,

        ],200);

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

            $product->name = ($request->name);
            $product->description = ($request->description);
            $product->stock = ($request->stock);
            $categories = Category::find(explode(",", $request->CategoryList));

            $product->save();
            $product->categories()->syncWithoutDetaching($categories);
            $categories = $product->categories;

            $view = view('products.layouts.tableRow', compact('product', 'categories'))->render();

            return response()->json([
                "message" => __('messages.successfullyUpdate', ["Object" => $product->name]),
                'html' => $view,

            ],200);

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
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $name = Product::find($id)->name;
        Product::destroy($id);
        return response()->json([
            'message' => __('messages.successfullyDeleted', ["Object" => $name]),
        ],200);

    }

}

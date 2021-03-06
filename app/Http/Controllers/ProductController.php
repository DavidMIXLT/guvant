<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Category;
use AlaCartaYa\Pagination;
use AlaCartaYa\Product;
use Illuminate\Http\Request;

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

    public function massiveElimination(Request $request)
    {
        $decode = json_decode($request->getContent(), true);
        Product::destroy($decode['listofid']);

        return response()->json([

            'message' => __('messages.deleted'),

        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        //Usado para Obtener el numero de productos que se va a devolver
        $NumberOfItems = Pagination::getNumberofItems($request);
        //Obtiene los objetos de los productos de la base de datos y como parametro se le pasa el numero de Items
        $products = Product::paginate($NumberOfItems);
        /**
         * Si la peticion es ajax
         */
        if ($request->ajax()) {
            //Se renderizan las filas de la tabla
            $html = Product::renderRows($products);
            //Objeto pagination se renderiza
            $paginationHTML = view('layouts.pagination', ['object' => $products])->render();
            return response()->json([
                'html' => $html,
                'paginationHTML' => $paginationHTML,
                'items' => $products,

            ], 200);

        } else {
            /**
             * Si la peticion no es ajax significa que es la primera vez que entra a la web se renderiza toda
             */
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
            /**
             * Se crea un producto nuevo  porque la vista products.create necesita de un producto
             */
            $product = new Product;
            $categories = Category::all();
            $view = view('products.create', compact('product', 'categories'))->render();
            return response()->json([
                'html' => $view,

            ], 200);

        } else {
            /**
             * Si el usuario a entrado manualmente en la ruta lo devolvemos a la pagina index
             */
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
        /**
         * en el $request en el campo categorylist se envia una string con las categorias separadas por comas
         * las separamos y buscamos todas las categorias
         */
        $category = Category::find(explode(",", $request->CategoryList));
        /**
         * Enganchamos las categorias a los productos
         */
        $product->categories()->attach($category);

        //  $categories = $product->categories;
        //  $a = $product->Name;
        /**
         * Se renderiza la fila del nuevo producto
         */
        $view = view('products.layouts.tableRow', compact('product', 'categories'))->render();
        return response()->json([
            'message' => __("messages.successfullyCreated", ['Object' => $product->name]),
            'html' => $view,

        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = Product::find($id);
            $categories = $product->categories;
            $a = $product->Name;
            $view = view('products.layouts.tableRow', compact('product', 'categories'))->render();
            return response()->json([
                'html' => $view,

            ], 200);
        } else {
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
        /**
         * Buscamos el producto si no existe hacemos que falle
         */
        $product = Product::findOrFail($id);
        /**
         * @param int $ids creamos un array vacio para guardar todos los ids de las categorias
         */
        $ids = array();
        //Se recorre cada categoria y guarda en los $ids el id de la categoria
        foreach ($product->categories as $category) {
            $ids[] = $category->id;
        }
        /**
         * @param int SelectedCategories se guardan las categorias del producto
         */
        $SelectedCategories = $product->categories;
        /**
         * @param int categories obtiene todas las categorias existentes pero "elimina" las categorias que tiene el
         * producto actual asignado
         */
        $categories = Category::whereNotIn('id', $ids)->get();
        //Renderizar HTML
        $view = view('products.edit', compact('product', 'categories', 'SelectedCategories'))->render();
        //Respuesta
        return response()->json([
            'html' => $view,
            'message' => $ids,

        ], 200);

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
//----------------------------------------------------------------------------\\
        /*
        Si en el request nos envian la variable stockActualizar
        significa que nos estan enviado mas de un producto a actualizar
         */
        if ($id != "mul") {
            $product = Product::find($id);
//----------------------------------------------------------------------------\\
            //Se valida el producto
            $product->validate($request);
//----------------------------------------------------------------------------\\
            //Se crea el producto y se guarda en la base de datos

            $product->name = ($request->name);
            $product->description = ($request->description);
            $product->stock = ($request->stock);
            $product->save();
//----------------------------------------------------------------------------\\
            /**
             * Obtenemos todos los ids de las categorias que nos han mandado y los buscamos en la base de datos
             * y luego las que no teniamos attach() se sincroniza
             */
            $categories = Category::find(explode(",", $request->CategoryList));
            $product->categories()->syncWithoutDetaching($categories);
//----------------------------------------------------------------------------\\
            $categories = $product->categories;
            //Renderizar HTML
            $view = view('products.layouts.tableRow', compact('product', 'categories'))->render();
            /**
             * RESPUESTA
             */
            return response()->json([
                "message" => __('messages.successfullyUpdate', ["Object" => $product->name]),
                'html' => $view,

            ], 200);

        } else {
            //----------------------------------------------------------------------------\\
            /**
             * Eliminacion normal solo entra si el usuario ha hecho click
             */
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
            //----------------------------------------------------------------------------\\

        }
        //----------------------------------------------------------------------------\\
        /**
         * RETURN
         */
        $products = Product::all();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
        //----------------------------------------------------------------------------\\
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
        ], 200);

    }

}

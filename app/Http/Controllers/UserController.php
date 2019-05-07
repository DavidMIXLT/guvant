<?php

namespace AlaCartaYa\Http\Controllers;

use Illuminate\Http\Request;
use AlaCartaYa\Pagination;
use AlaCartaYa\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        //
          //Usado para Obtener el numero de productos que se va a devolver
          $NumberOfItems = Pagination::getNumberofItems($request);
          //Obtiene los objetos de los productos de la base de datos y como parametro se le pasa el numero de Items
          $users = User::paginate($NumberOfItems);
          if ($request->ajax()) {
            //Se renderizan las filas de la tabla
            $html = User::renderRows($users);
            //Objeto pagination se renderiza
            $paginationHTML = view('layouts.pagination', ['object' => $users])->render();
            return response()->json([
                'html' => $html,
                'paginationHTML' => $paginationHTML,
                'items' => $users,

            ], 200);

        } else {
            /**
             * Si la peticion no es ajax significa que es la primera vez que entra a la web se renderiza toda
             */
     
            return view('users.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $view = view('users.create')->render();
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
        $user = new User();
        $user->validate($request);
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        $view = view("users.layouts.tablerow", compact("user"))->render();
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
        $user = User::find($id);
        $view = view('users.edit', compact('user'))->render();
        return response()->json([
            'status' => 'success',
            'html' => $view,
        ]);
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
        
        $user = User::findOrFail($id);
        try{
            $user->delete();
          
        return response()->json([
            'status' => 'success',
            'message' => __('messages.deleted'),

        ]);
        }catch(\Exception $e){
          
        return response()->json([
            'status' => 'success',
            'message' => "error",

        ]);
        }
    }
}

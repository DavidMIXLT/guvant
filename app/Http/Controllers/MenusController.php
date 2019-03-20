<?php

namespace AlaCartaYa\Http\Controllers;

use AlaCartaYa\Group;
use AlaCartaYa\Menu;
use AlaCartaYa\Pagination;
use AlaCartaYa\Plate;
use AlaCartaYa\Product;
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

            $view = view('menus.create')->render();

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
        /**
         * Descodifica la peticion AJAX
         */
        $decode = json_decode($request->getContent(), true);
//----------------------------------------------------------------------------\\
        /**
         * Se crea un menu vacio y despues se cargan los datos pasados por el AJAX
         */
        $menu = new Menu();

        $menu->name = $decode['name'];
        $menu->price = $decode['price'];

        $menu->save();
//----------------------------------------------------------------------------\\
        /**
         * Se recorre el array de grupos y luego se van creando
         */
        foreach ($decode['groups'] as $group) {
            $newGroup = new Group();
            $newGroup->name = $group['name'];
            $newGroup->save();
            //----------------------------------------------------------------------------\\
            /**
             * Se buscan los productos pasados y los platos y despues se hace un attach()
             */
            $Products = Product::find($group['ProductsID']);
            $Plates = Plate::find($group['PlatesID']);
            $newGroup->plates()->attach($Plates);
            $newGroup->products()->attach($Products);
            //----------------------------------------------------------------------------\\
            /**
             * Se hace un attach por ultimo al menu del grupo creado
             */
            $menu->groups()->attach($newGroup);
            //----------------------------------------------------------------------------\\
        }
//----------------------------------------------------------------------------\\
        /**
         * RENDER
         */
        $html = view("menus.layouts.tableRow", compact('menu'))->render();
        /**
         * RETURN
         */
        return response()->json([
            'status' => 'success',
            'html' => $html,
            'message' => __('messages.successfullyCreated', ["Object" => $menu->name]),

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
    public function edit(Menu $menu)
    {
        $groups = $menu->groups();
        $html = view("menus.edit", compact('menu'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,

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
        $decode = json_decode($request->getContent(), true);

        $menu = Menu::find($id);

        $menu->name = $decode['name'];
        $menu->price = $decode['price'];

        $menu->save();

        foreach ($decode['groups'] as $group) {
            $groupF = Group::where('id', '=', $group['GroupID'])->first();
            if ($groupF === null) {
                $newGroup = new Group();
                $newGroup->name = $group['name'];
                $newGroup->save();

                $Products = Product::find($group['ProductsID']);
                $Plates = Plate::find($group['PlatesID']);
                $newGroup->plates()->attach($Plates);
                $newGroup->products()->attach($Products);

                $menu->groups()->attach($newGroup);
            } else {
                $groupF->name = $group['name'];
                $groupF->save();
                $Products = Product::find($group['ProductsID']);
                $Plates = Plate::find($group['PlatesID']);
                $groupF->plates()->sync($Plates);
                $groupF->products()->sync($Products);

                $menu->groups()->sync($groupF);
            }

        }
        $html = view("menus.layouts.tableRow", compact('menu'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $html,
            'message' => __('messages.successfullyCreated', ["Object" => $menu->name]),

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($id == -1) {
            $decode = json_decode($request->getContent(), true);
            $menus = Menu::find($decode['listofid']);
            foreach ($menus as $menu) {
                $menu->groups()->delete();
                $menu->delete();
            }

        } else {
            $menu = Menu::find($id);
            $menu->groups()->delete();
            $menu->delete();

        }

        return response()->json([
            'message' => __('messages.deleted'),

        ], 200);
    }

    public function newGroup(Request $request)
    {
        if ($request->ajax()) {

            $html = view('menus.layouts.groups', ['title' => $request->id])->render();
            return response()->json([
                'html' => $html,

            ], 200);
        }
    }

    public function searchModal(Request $request)
    {
        if ($request->ajax()) {

            $html = view('menus.layouts.search', ["id" => 'ModalSearch'])->render();
            return response()->json([
                'html' => $html,

            ], 200);
        } else {
            return "No permission";
        }
    }
}

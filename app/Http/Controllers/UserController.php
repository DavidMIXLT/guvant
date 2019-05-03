<?php

namespace AlaCartaYa\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
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


    public function index()
    {
        //
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
        
        $user = User::findOrFail($id);
        try{
            $user->delete();
            return redirect('/usuaris')->with('status', 'Usuario borrado correctament.');
        }catch(\Exception $e){
            return redirect("/usuaris")->with('status',"Usuario no se ha podido borrar.");
        }
    }
}

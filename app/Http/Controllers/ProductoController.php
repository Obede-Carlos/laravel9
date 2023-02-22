<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $this->authorize("viewAny", Product::class);
        return view("producto.index"); //Primer productList es lo que enviaremos al index. Segundo productList es la variable donde cogera los datos. Estamos enlazando ambos nombres
    }

    public function indexhtml()
    {   
        $this->authorize("viewAny", Product::class); //Regla en app/Policies para restringir acceso. Le añadimos el objeto de la clase de la politica para que se dirija ahí
        $products = Product::all();
        return view("producto.html", ["productList" => $products]); //Primer productList es lo que enviaremos al index. Segundo productList es la variable donde cogera los datos. Estamos enlazando ambos nombres
    }

    public function indexjson()
    {
        $this->authorize("viewAny", Product::class); //Regla en app/Policies para restringir acceso. Le añadimos el objeto de la clase de la politica para que se dirija ahí
        $products = Product::all();
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

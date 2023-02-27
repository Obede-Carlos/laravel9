<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    //Filtro añadido al controlador. Tendrá que estar el usuario registrado para que pueda acceder
    public function __construct()
    {
        $this->middleware("auth");
        //$this->middleware("auth")->only("index"); Filtrar solo Index
        //$this->middleware("auth")->except("index"); Filtrar todo menos index
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publisherList = Publisher::all();
        return view("publisher.index", ["publisherList" => $publisherList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("publisher.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre"=> "required|max: 100",
            "director"=>"required",
            "plantas" => "required|numeric|gt:0",
            "empleados" => "required|numeric|gt:0"
        ],[
            "nombre.required" => "El titulo es obligatorio",
            "nombre.max" => "El titulo debe contener 100 carácteres como máximo",
            "director.required" => "El genero debe ser obligatorio",
            "plantas.required" => "Los ejemplares son obligatorios",
            "plantas.numeric.gt" => "Los ejemplares deben ser un numero superior a cero",
            "empleados.required" => "El precio es obligatorio",
            "precio.numeric.gt"=> "El precio debe ser un numero superior a cero",
        ]);
        
        Publisher::create($request->all());
        return redirect()->route("publisher.index")->with("exito", "editorial añadida correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publisher = Publisher::find($id);
        $books = Book::where('publisher_id', $id)->get();
        return view("publisher.show", ["publisher" => $publisher])->with('books', $books);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publisher = Publisher::find($id);        
        return view("publisher.edit",["publisher" => $publisher]);
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
        $request->validate([
            "nombre"=> "required|max: 100",
            "director"=>"required",
            "plantas" => "required|numeric|gt:0",
            "empleados" => "required|numeric|gt:0"
        ],[
            "nombre.required" => "El titulo es obligatorio",
            "nombre.max" => "El titulo debe contener 100 carácteres como máximo",
            "director.required" => "El genero debe ser obligatorio",
            "plantas.required" => "Los ejemplares son obligatorios",
            "plantas.numeric.gt" => "Los ejemplares deben ser un numero superior a cero",
            "empleados.required" => "El precio es obligatorio",
            
        ]);

        $publisher = Publisher::Find($id);
        $publisher->nombre = $request->input("nombre");
        $publisher->director = $request->input("director");
        $publisher->plantas = $request->input("plantas");
        $publisher->empleados = $request->input("empleados");
        $publisher->save();

        return redirect()->route("publishers.index")->with("exito", "editorial actualizada correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::Find($id);
        $publisher->delete();
        return redirect()->route("publishers.index")->with("exito", "editorial eliminad correctamente");
    }
}

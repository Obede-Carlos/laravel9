<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
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
        $bookList = Book::all();
        return view("book.index", ["bookList" => $bookList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        return view("book.create")->with('publishers', $publishers);
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
            "titulo"=> "required|max: 100",
            "genero"=>"required",
            "autor"=>"required",
            "ejemplares" => "required|numeric|gt:0",
            "precio" => "required|numeric|gt:0"
        ],[
            "titulo.required" => "El titulo es obligatorio",
            "titulo.max" => "El titulo debe contener 100 carácteres como máximo",
            "genero.required" => "El genero debe ser obligatorio",
            "autor.required" => "El autor debe ser obligatorio",
            "ejemplares.required" => "Los ejemplares son obligatorios",
            "ejemplares.numeric.gt" => "Los ejemplares deben ser un numero superior a cero",
            "precio.required" => "El precio es obligatorio",
            "precio.numeric.gt"=> "El precio debe ser un numero superior a cero",
            
        ]);


        //debido a que el publisher_id tiene que ser un id de un dato de otra tabla es decir un id ya existente,
        //la manera correcta de ingresar un libro es mediante el meteodo antiguo ir uno a uno con el request inpu,
        //por ulitmo hacer un save
        //para que funcione el publisher_id en la vista hay que llamar el select donde estan las opciones "publisher_id".
        $book = new Book();
        $book->titulo = $request->input("titulo");
        $book->genero = $request->input("genero");
        $book->autor = $request->input("autor");
        $book->ejemplares = $request->input("ejemplares");
        $book->precio = $request->input("precio");
        $book->publisher_id = $request->input('publisher_id');
        $book->save();
        return redirect()->route("books.index")->with("exito", "libro añadido correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        $publisher = Publisher::find($book->publisher_id); 
        return view("book.show", ["book" => $book])->with('publisher', $publisher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);       
        return view("book.edit",["book" => $book]);
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
            "titulo"=> "required|max: 100",
            "genero"=>"required",
            "autor"=>"required",
            "ejemplares" => "required|numeric|gt:0",
            "precio" => "required|numeric|gt:0"
        ],[
            "titulo.required" => "El titulo es obligatorio",
            "titulo.max" => "El titulo debe contener 100 carácteres como máximo",
            "genero.required" => "El genero debe ser obligatorio",
            "autor.required" => "El autor debe ser obligatorio",
            "ejemplares.required" => "Los ejemplares son obligatorios",
            "ejemplares.numeric.gt" => "Los ejemplares deben ser un numero superior a cero",
            "precio.required" => "El precio es obligatorio",
            "precio.numeric.gt"=> "El precio debe ser un numero superior a cero",
        ]);

        $book = Book::Find($id);
        $book->titulo = $request->input("titulo");
        $book->genero = $request->input("genero");
        $book->autor = $request->input("autor");
        $book->ejemplares = $request->input("ejemplares");
        $book->precio = $request->input("precio");
        $book->save();

        return redirect()->route("books.index")->with("exito", "libro actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::Find($id);
        $book->delete();
        return redirect()->route("books.index")->with("exito", "libro eliminado correctamente");
    }
}

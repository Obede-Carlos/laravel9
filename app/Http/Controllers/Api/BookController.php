<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /* Funcion por si queremos añadir en cada función la verificación, para no tener que copiar y pegar el mismo codigo todo el rato
    public function check404($study)
    {
        if (!$study) {
            response()->json(['status' => 404,'message' => 'No se ha encontrado un estudio con ese id'], 404)->send();
        die();
    }
}
    */

    //Le metemos un middleware para que tenga que estar autenticado para continuar
    public function __construct()
    {
        $this->middleware("auth:api");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Se debería devolver un objeto con una propiedad como mínimo data y el array de resultados en esa propiedad.
    // A su vez también es necesario devolver el código HTTP de la respuesta.
    public function index()
    {
        //Autorización de acceso. Asi sería en web:
        //$this->authorize("viewAny", Book::class);

        //En API. Comprobará BookPolicy
        $user = \Auth::user();
        if ($user->can("viewAny", Book::class)) {

            // return Book::all(); Version incompleta. Version completa es devolver Booko en json con un status
            $books = Book::all();

            return response()->json(['status' => 'ok', 'data' => $books], 200);
        }else{
            return response()->json(['status' => 'NOK', "message" => "No tiene permiso de acceso"], 403);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        //En la api el validate no valdría ya que manda datos, no va a redireccionar de nuevo al formulario si fallase
        $request->validate([
            "titulo"=> "required|max: 100",
            "genero"=>"required",
            "autor"=>"required",
            "ejemplares" => "required|numeric|gt:0",
            "precio" => "required|numeric|gt:0"
        ]);*/

        //Para ello utilizamos Validator para validar los datos. Es un facade
        $validated = Validator::make($request->all(), [
            "titulo"=> "required|max: 100",
            "genero"=>"required",
            "autor"=>"required",
            "ejemplares" => "required|numeric|gt:0",
            "precio" => "required|numeric|gt:0"
        ]);

        if ($validated->fails()) {
            return response()->json(["status" => "NOK", "errors" => $validated->errors()], 422); //422 “unprocessable entity.”
        }
        $newBook = Book::create($request->all());
        return response()->json(["status" => "ok", "data" => $newBook], 201); //Cuando se crea algo se devuelve 201 - Created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Corresponde con la ruta /studies/{study}
        // Buscamos un study por el ID.
        $book = Book::find($id);

        // Chequeamos si encontró o no el Book
        if (!$book) {
            // Se devuelve un array errors con los errores detectados y código 404
            return response()->json(['errors' => (['code' => 404, 'message' => 'No se encuentra un Libro con ese código.'])], 404);
        }

        // Devolvemos la información encontrada.
        return response()->json(['status' => 'ok', 'data' => $book], 200);
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
        //Que busque el Booko y de un error si no lo encuentra
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['status' => 'NOK', 'message' => 'No se encuentra un Libro con ese código.'], 404);
        }

        //Validamos y creamos
        $validated = Validator::make($request->all(), [
            "titulo"=> "required|max: 100",
            "genero"=>"required",
            "autor"=>"required",
            "ejemplares" => "required|numeric|gt:0",
            "precio" => "required|numeric|gt:0"
        ]);

        if ($validated->fails()) {
            return response()->json(["status" => "NOK", "errors" => $validated->errors()], 422); //422 “unprocessable entity.”
        }

        //Obtenemos todos datos y los guardamos
        $book->fill($request->all());
        $book->save();

        return response()->json(['status' => 'ok', 'data' => $book], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['status' => 'NOK', 'message' => 'No se encuentra un Libro con ese código.'], 404);
        }

        try {
            $book->delete();
            return response()->json(["mensaje" => "Borrado Correctamente"], 204);
        } catch (\Throwable $th) {
            return response()->json(["status" => "NOK", "mensaje" => "Borrado fallido", "error" => $th->getMessage()], 409);
        }
    }
}

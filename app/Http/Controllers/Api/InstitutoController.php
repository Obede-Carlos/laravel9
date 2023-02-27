<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instituto;
use Illuminate\Http\Request;

class InstitutoController extends Controller
{


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

        //En API. Comprobará ProductPolicy
        $user = \Auth::user();
        if ($user->can("viewAny", Product::class)) {

            $products = Product::all();

            return response()->json(['status' => 'ok', 'data' => $products], 200);
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
        //Para ello utilizamos Validator para validar los datos. Es un facade
        $validated = Validator::make($request->all(), [
            "nombre" => "required|max: 100",
            "precio" => "required|numeric|gt:0",
            "descripcion" => "required"
        ]);

        if ($validated->fails()) {
            return response()->json(["status" => "NOK", "errors" => $validated->errors()], 422); //422 “unprocessable entity.”
        }
        $newInstituto = Instituto::create($request->all());
        return response()->json(["status" => "ok", "data" => $newInstituto], 201); //Cuando se crea algo se devuelve 201 - Created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instituto = Instituto::find($id);

        // Chequeamos si encontró o no el instituto
        if (!$instituto) {
            // Se devuelve un array errors con los errores detectados y código 404
            return response()->json(['errors' => (['code' => 404, 'message' => 'No se encuentra un instituto con ese código.'])], 404);
        }

        // Devolvemos la información encontrada.
        return response()->json(['status' => 'ok', 'data' => $instituto], 200);
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
        $instituto = Instituto::find($id);

        if (!$instituto) {
            return response()->json(['status' => 'NOK', 'message' => 'No se encuentra un instituto con ese código.'], 404);
        }

        try {
            $instituto->delete();
            return response()->json(["mensaje" => "Borrado Correctamente"], 204);
        } catch (\Throwable $th) {
            return response()->json(["status" => "NOK", "mensaje" => "Borrado fallido", "error" => $th->getMessage()], 409);
        }
    }
}

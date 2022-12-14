<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudyController; //Añadimos el studycontroller para enrutar los metodos de la clase
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Ejecuta de la lista la primera que encuentre correcta, luego se sale. Si tuvieramos 2 "/hola" con cosas diferentes cogería la primera y nunca entraría a la segunda
Route::get('/', function () {
    return view('welcome');
});

Route::get("/hola", function (){
    echo "Hola mundo";
});

Route::get("/hola/{nombre}", function ($nombre){ //Los parametros se añade en la ruta entre llaves {}. Lo que haya dentro llegará como parametro a la función que ponga
    echo "Hola $nombre";
});

Route::get("/saludo/{nombre?}", function ($nombre = "Mundo"){// El interrogante es para decirle que si no se inserta ningún parametro en la ruta que ponga mundo. Si pone parametro que salga el parametro
    echo "Hola $nombre";
});


//Rutas del ejercicio Study
Route::get("/studies", [StudyController::class, "index"]); //Enrutamos el metodo index de la clase StudyController. Cuando pongamos /studies en el navegador devolveremos index

Route::get("/studies/create", [StudyController::class, "create"]); //El orden importa. Si lo pongo debajo de show cogera "create" como parametro. Al ponerlo encima reservamos la palabra create solo para este método

Route::get("/studies/{id}", [StudyController::class, "show"]);

Route::get("/studies/{id}/edit", [StudyController::class, "edit"]);
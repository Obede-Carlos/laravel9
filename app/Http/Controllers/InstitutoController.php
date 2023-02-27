<?php

namespace App\Http\Controllers;

use App\Models\Instituto;
use Illuminate\Http\Request;

class InstitutoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutosList = Instituto::all();
        return view("instituto.index", ["institutosList" => $institutosList]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instituto = Instituto::find($id);       
        return view("instituto.edit",["instituto" => $instituto]);
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
        //validacion de los campos 
        $request->validate([
            "cod_instituto"=> "required|max:10",
            "nombre"=>"required|max:120",
            "localidad"=>"required|max:50",
            "numalumnos" => "required|gt:60 ",
        ],[
            "cod_instituto.required"=> "Debes rellenar el campo del codigo insituto",
            "cod_instituto.max"=> "El codigo del instituto solo puede contener 10 carácteres como máximo",
            "nombre.required"=> "Debes rellenar el campo del nombre",
            "nombre.max"=> "El nombre solo puede contener 120 carácteres como máximo",
            "localidad.required"=> "Debes rellenar el campo localidad",
            "localidad.max"=> "La localidad solo puede contener 50 carácteres como máximo",
            "numalumnos.required"=> "Debes rellenar el campo numero de alumnos",
            "numalumnos.gt" => "el campo numalumnos debe empezar por 60",
            
        ]);

        $instituto = Instituto::Find($id);
        $instituto->cod_instituto = $request->input("cod_instituto");
        $instituto->nombre = $request->input("nombre");
        $instituto->localidad = $request->input("localidad");
        $instituto->numalumnos = $request->input("numalumnos");
        $instituto->save();

        return redirect()->route("institutos.index")->with("exito", "Instituto actualizado correctamente");
    }
}

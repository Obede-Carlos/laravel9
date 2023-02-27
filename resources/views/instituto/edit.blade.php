@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Editar Institutos</h1>
            <br>

            <a class="btn btn-primary" href="{{route('institutos.index')}}">Lista Institutos</a>

            @if($errors->any()) <!--Tratamos los errores del required en el método create (devuelve array de errores)-->
            
            <div class="alert alert-danger" style="width: 30%;">
                <h5>Por favor, corrige los siguientes errores:</h5>
                <ul>
                    @foreach($errors->all() as $error) <!--Recogo todos los errores y los muestro-->
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('institutos.update', $instituto->id) }}" method="POST">
                @csrf <!--Hay que ponerlo para que no de error 404. Medida de seguridad-->
                @method("PUT") <!--Indicamos que es metodo PUT para el edit-->
                <br>
                Cod_instituto: <input type="text" name="cod_instituto" id=" cod_instituto" value="{{ $institutos->cod_instituto ?? '' }}"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Nombre: <input type="text" name="nombre" id="nombre" value="{{ $institutos->nombre ?? '' }}">
                <br><br>
                Localidad: <input type="text" name="localidad" id="localidad" value="{{ $institutos->localidad ?? '' }}">
                <br><br>
                Numalumnos: <input type="text" name="numalumnos" id="numalumnos" value="{{ $institutos->numalumnos ?? '' }}">
                <br><br>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop
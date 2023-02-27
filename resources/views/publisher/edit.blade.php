@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Editar Editorial</h1>
            <br>

            <a class="btn btn-primary" href="{{route('publishers.index')}}">Lista Editoriales</a>

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

            <form action="{{ route('publishers.update', $publisher->id) }}" method="POST"> 
                @csrf <!--Hay que ponerlo para que no de error 404. Medida de seguridad-->
                @method("PUT") <!--Indicamos que es metodo PUT para el edit-->
                <br>
                Nombre: <input type="text" name="nombre" id="nombre" value="{{ $publisher->nombre ?? '' }}"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Director: <input type="text" name="director" id="director" value="{{ $publisher->director ?? '' }}"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Plantas: <input type="text" name="plantas" id="plantas" value="{{ $publisher->plantas ?? '' }}">
                <br><br>
                Empleados: <input type="text" name="empleados" id="empleados" value="{{ $publisher->empleados ?? '' }}">
                <br><br>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <h1>Editar Libro</h1>
            <br>

            <a class="btn btn-primary" href="{{route('books.index')}}">Lista Libros</a>

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

            <form action="{{ route('books.update', $book->id) }}" method="POST"> 
                @csrf <!--Hay que ponerlo para que no de error 404. Medida de seguridad-->
                @method("PUT") <!--Indicamos que es metodo PUT para el edit-->
                <br>
                Titulo: <input type="text" name="titulo" id="titulo" value="{{ $book->titulo ?? '' }}"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Genero: <input type="text" name="genero" id="genero" value="{{ $book->genero ?? '' }}"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Autor: <input type="text" name="autor" id="autor" value="{{ $book->autor ?? '' }}">
                <br><br>
                Ejemplares: <input type="text" name="ejemplares" id="ejemplares" value="{{ $book->ejemplares ?? '' }}">
                <br><br>
                precio: <input type="text" name="precio" id="precio" value="{{ $book->precio ?? '' }}">
                <br><br>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
            <br>

            <div>
        <div>
    <div>

@stop
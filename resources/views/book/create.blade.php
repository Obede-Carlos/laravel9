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

            <form action="{{ route('books.store') }}" method="POST"> {{-- Tambien puede ser como Ruta + array asociativo (mas correcto) {{ route('clients.update', ['client' => $client->id ]) }}--}}
                @csrf {{--Hay que ponerlo para que no de error 404. Medida de seguridad--}}
                
                <br>
                Titulo: <input type="text" name="titulo" id="titulo"> <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Genero: <input type="text" name="genero" id="genero" > <!--Operador ternario BLADE. En caso de no encontrar nombre que ponga el campo vacio ''-->
                <br><br>
                Autor: <input type="text" name="autor" id="autor" >
                <br><br>
                Ejemplares: <input type="text" name="ejemplares" id="ejemplares" >
                <br><br>
                Precio: <input type="text" name="precio" id="precio" >
                <br><br>
                Editorial:  
                <select name="publisher_id">
                    @foreach($publishers as $publisher )
                        <option value="{{ $publisher-> id}}" name="publisher_id" id="publisher_id">{{ $publisher-> nombre }}</option>
                    @endforeach
                </select>
                <br><br>
                <button type="submit" class="btn btn-primary">Crear Libro</button>
            </form>
            <br>
            <div>
        <div>
    <div>

@stop
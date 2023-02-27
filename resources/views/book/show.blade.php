@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Detalle Libro</h1>
            <br>
            
            <a class="btn btn-primary" href="{{route('books.index')}}">Lista Libro</a>

            <table class="table table-striped">
                <tr>
                    <th><b>Titulo</b></th>
                    <th>Genero</th>
                    <th>Autor</th>
                    <th>Ejemplares</th>
                    <th>Precio</th>
                    <th></th>
                    <th></th>
                </tr>
                
                <tr>
                    <td>{{ $book->titulo }}</td>
                    <td>{{ $book->genero }}</td>
                    <td>{{ $book->autor }}</td>
                    <td>{{ $book->ejemplares }}</td>
                    <td>{{ $book->precio }}</td>
                    
                    <td>
                        <a class="btn btn-primary" href="{{route('books.edit', $book->id)}}">Editar</a>
                    </td>                    

                    <td>
                        <form action="{{route('books.destroy', $book->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-warning">Borrar</button>
                        </form>
                    </td>

                </tr>
                
            </table>
            <br><br>
            <h3>Editorial</h3>
            <table class="table table-striped">              
                <tr>
                    <th>Nombre</th>
                    <th>Director</th>
                    <th>Plantas</th>
                    <th>Emplaeados</th>                    
                </tr>                
                <tr>
                    <td>{{ $publisher->nombre }}</td>
                    <td>{{ $publisher->director }}</td>
                    <td>{{ $publisher->plantas }}</td>
                    <td>{{ $publisher->empleados }}</td>
                </tr>                
            </table>
        <div>
    <div>
<div>

@stop


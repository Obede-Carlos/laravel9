@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Detalle de la Editorial</h1>
            <br>
            
            <a class="btn btn-primary" href="{{route('publishers.index')}}">Lista Editoriales</a>

            <table class="table table-striped">
                <tr>
                    <th><b>Nombre</b></th>
                    <th>Director</th>
                    <th>Plantas</th>
                    <th>Empleados</th>
                    <th></th>
                    <th></th>
                </tr>
                
                <tr>
                    <td>{{ $publisher->nombre }}</td>
                    <td>{{ $publisher->director }}</td>
                    <td>{{ $publisher->plantas }}</td>
                    <td>{{ $publisher->empleados }}</td>
                    
                    <td>
                        <a class="btn btn-primary" href="{{route('publishers.edit', $publisher->id)}}">Editar</a>
                    </td>                    

                    <td>
                        <form action="{{route('publishers.destroy', $publisher->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-warning">Borrar</button>
                        </form>
                    </td>

                </tr>
                
            </table>
            <br><br>
            
            <h3>Libros publicados</h3>
            @if(empty($books))
                <h3>Esta editorial no tiene libros publicados</h3>
            @else
                @foreach($books as $book)
                <table class="table table-striped">              
                    <tr>
                        <th>Titulo</th>
                        <th>Genero</th>
                        <th>Autor</th>
                        <th>Ejemplares</th>
                        <th>Precio</th>
                        <th>Editorial</th>                  
                    </tr>                
                    <tr>
                        <td>{{ $book->titulo }}</td>
                        <td>{{ $book->genero }}</td>
                        <td>{{ $book->autor }}</td>
                        <td>{{ $book->ejemplares }}</td>
                        <td>{{ $book->precio }}</td>
                    </tr>                
                </table>
                @endforeach
            @endif
        <div>
    <div>
<div>

@stop


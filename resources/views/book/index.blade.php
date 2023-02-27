@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($message = Session::get("exito"))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
            @endif
            <h1 style="text-align: center;">Lista de Libros</h1>
            <br>

            <a class="btn btn-primary" href="{{route('books.create')}}">Nuevo Libro</a>
            <br><br>
            <table class="table table-striped">
                <tr style="text-align: center;">
                    <th>Titulo</th>
                    <th>Genero</th>
                    <th>Autor</th>
                    <th>Ejemplares</th>
                    <th>Precio</th>
                    <th>Editorial</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($bookList as $book)
                <tr>
                    <td>{{ $book->titulo }}</td>
                    <td>{{ $book->genero }}</td>
                    <td>{{ $book->autor }}</td>
                    <td>{{ $book->ejemplares }}</td>
                    <td>{{ $book->precio }}</td>
                    <td>{{ $book->publisher_id }}</td>

                    <td>
                        <a class="btn btn-primary" href="{{route('books.edit', $book->id)}}">Editar</a>
                    </td>

                    <td>
                        <a class="btn btn-primary" href="{{route('books.show', $book->id)}}">Ver</a>
                    </td>

                    <td>
                        <form action="{{route('books.destroy', $book->id)}}" method="post">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn btn-warning">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        <div>
    <div>
<div>

@stop


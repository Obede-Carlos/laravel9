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
            <h1 style="text-align: center;">Lista de Editoriales</h1>
            <br>

            <a class="btn btn-primary" href="{{route('publishers.create')}}">Nueva Editorial</a>
            <br><br>
            <table class="table table-striped">
                <tr style="text-align: center;">
                    <th>Nombre</th>
                    <th>Director</th>
                    <th>Plantas</th>
                    <th>Empleados</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($publisherList as $publisher)
                <tr>
                    <td>{{ $publisher->nombre }}</td>
                    <td>{{ $publisher->director }}</td>
                    <td>{{ $publisher->plantas }}</td>
                    <td>{{ $publisher->empleados }}</td>

                    <td>
                        <a class="btn btn-primary" href="{{route('publishers.edit', $publisher->id)}}">Editar</a>
                    </td>

                    <td>
                        <a class="btn btn-primary" href="{{route('publishers.show', $publisher->id)}}">Ver</a>
                    </td>

                    <td>
                        <form action="{{route('publishers.destroy', $publisher->id)}}" method="post">
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


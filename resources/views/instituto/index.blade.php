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

            <h1 style="text-align: center;">Lista de Institutos</h1>
            <br>

            <table class="table table-striped">
                <tr style="text-align: center;">
                    <th>Cod_instituto</th>
                    <th>Nombre</th>
                    <th>Localidad</th>
                    <th>Numalumnos</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($institutosList as $instituto)
                <tr>
                    <td>{{ $instituto->cod_instituto }}</td>
                    <td>{{ $instituto->nombre }}</td>
                    <td>{{ $instituto->localidad }}</td>
                    <td>{{ $instituto->numalumnos }}</td>

                    <td>
                        <a class="btn btn-primary" href="{{route('institutos.edit', $instituto->id)}}">Editar</a>
                    </td>
                </tr>
                @endforeach
            </table>
        <div>
    <div>
<div>

@stop


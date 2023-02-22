@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 style="text-align: center;">Lista de productos</h1>
           
            @can("create", App\Models\Product::class) 
            <a class="btn btn-primary" href="{{route('products.create')}}">Nuevo Producto</a>
            @endcan
           
            <br><br>
            <div id="tablejson">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                    <tbody id="myTbody">

                    </tbody>
                </table>
            </div>
            <script>
                $(document).ready(function () {
                    //loadDataHtml();
                    loadDataJson();

                });
                const loadDataJson = function () {  
                    let url = "/productos/json";
                    $.get(url, function (data, status) {
                        console.log(data);
                        $("#myTbody").empty();
                        Object.keys(data).forEach(function (id) {
                            console.log(id);
                            console.log(data[id]);
                            var tr = document.createElement("tr");
                            tr.setAttribute("id", `tr${data[id].id}`);
                            let fila = "<td>" + data[id].nombre + "</td>";
                            fila += "<td>" + data[id].descripcion + "</td>";
                            fila += "<td>" + data[id].precio + "</td>";
                            tr.innerHTML = fila;
                            $("#myTbody").append(tr);
                        });
                    }).fail(function (e) {
                        console.log("Error "+ e.status);
                    });
                }
            </script>
        <div>
    <div>
<div>

@stop


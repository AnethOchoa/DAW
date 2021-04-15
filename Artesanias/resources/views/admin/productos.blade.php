@extends('admin.layouts.main')

@section('contenido')
    <h2>ESTOY EN EL PRODUCTO </h2>
    <form action="/admin/productos" method="POST">
    {{ csrf_field() }}
        <button type="submit" class= "btn btn-primary">Aceptar</button>
    </form>
@endsection
@section('scripts')
    <script>console.log("adads");</script>
@endsection
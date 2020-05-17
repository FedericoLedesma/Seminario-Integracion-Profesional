@extends('layouts.layout')
@section('titulo')
	Usuarios
@endsection
@section('content')
<!--    -->
<div id="Mostrar">
	<label>hola</label>
</div>

	<div id="alert" class="alert alert-info"></div>
	<a href="#" class="btn-delete">Eliminar</a>
	<button type="submit" class="btn btn-danger eliminar">Eliminar</button>
@endsection
@section('script')
<script src="{{asset('js/script.js')}}"></script>

@endsection
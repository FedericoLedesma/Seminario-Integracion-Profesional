@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('historialInternacion.index') }}">Historial pacientes</a></li>
		<li class="breadcrumb-item active">Ingresar paciente</li>
@endsection
@section('content')

<!-- CREATE ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
<h1>Se ingreso a un paciente correctamente</h1>
  @include('layouts.error')

<div>
  <div>
    <a href="{{action('HistorialInternacionController@index')}}" class="btn btn-primary">Volver al índice</a>
  </div>
</div>

@endsection

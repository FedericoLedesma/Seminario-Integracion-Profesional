@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('habitaciones.index') }}">Habitaciones</a></li>
		<li class="breadcrumb-item active">Ver habicación</li>
@endsection
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
<style>
<!--
	.table-resposive{
		float:left;
	}

-->
</style>
	   @include('layouts.error')
	  	@if($habitacion)
	    <div class="table-responsive">
	    <h2>Habitacion:  {{$habitacion->name}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$habitacion->id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$habitacion->name}}</td>
			</tr>
      <tr>
				<td>Cantidad de camas </td>
				<td>{{$habitacion->get_cantidad_camas()}}</td>
			</tr>
      <tr>
				<td>Cantidad de camas desocupadas </td>
				<td>{{$habitacion->get_cantidad_camas_desocupadas()}}</td>
			</tr>
      <tr>
				<td>Descripcion </td>
				<td>{{$habitacion->descripcion}}</td>
			</tr>
      <tr>
				<td>Sector </td>
				<td>{{$habitacion->get_sector_name()}}</td>
			</tr>
      <tr>
				<td>CREADO </td>
				<td>{{$habitacion->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$habitacion->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('habitaciones.edit', $title = 'MODIFICAR', $parameters = [$habitacion->id],['class' => 'btn btn-warning'], $attributes = [])!!}




@endif
@endsection

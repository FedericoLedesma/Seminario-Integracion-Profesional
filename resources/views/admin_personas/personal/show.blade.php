@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personal.index') }}">Personal</a></li>
		<li class="breadcrumb-item active">Ver personal</li>
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
	  	@if($personal)




	    <div class="table-responsive">
	    <h2>Datos de {{$personal->get_name()}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$personal->get_id()}}</td>
			</tr>
			<tr>
				<td>Nombre </td>
				<td>{{$personal->get_name()}}</td>
			</tr>
			<tr>
				<td>Apellido </td>
				<td>{{$personal->get_apellido()}}</td>
			</tr>
			<tr>
				<td>Sector </td>
				<td>{{$personal->get_sector_name()}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$personal->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$personal->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('personal.edit', $title = 'Cambiar de sector', $parameters = [$personal],['class' => 'btn btn-warning'], $attributes = [])!!}
  {!!link_to_route('personas.edit', $title = 'Modificar datos personales', $parameters = [$personal->get_persona()],['class' => 'btn btn-warning'], $attributes = [])!!}
  {!!link_to_route('personal.showProfesiones', $title = 'Profesiones', $parameters = [$personal->get_persona()],['class' => 'btn btn-warning'], $attributes = [])!!}
@endif
@endsection

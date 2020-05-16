@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('roles.index') }}">Roles</a></li>
		<li class="breadcrumb-item active">Ver Rol</li>
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
	  	@if($role)




	    <div class="table-responsive">
	    <h2>Rol  {{$role->name}}</h2>
        <div class="col-md-3 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$role->id}}</td>
			</tr>
			<tr>
				<td>NOMBRE </td>
				<td>{{$role->name}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$role->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$role->updated_at}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('roles.edit', $title = 'MODIFICAR', $parameters = [$role],['class' => 'btn btn-warning'], $attributes = [])!!}

	<h3>Permisos asociados</h3>
	@if($permisos)
	<div class="table-resposive">
        <div class="panel-heading">
		    <table class="table table-bordered table-striped">
		    @foreach($permisos as $permiso)
		    	<tr>
			 		<td>
			 			<label>{{$permiso}}</label>
			 		</td>
				</tr>

				@endforeach
			</table>
		</div>
	</div>
	@endif



@endif
@endsection

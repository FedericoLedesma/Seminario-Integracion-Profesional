@extends('layouts.plantilla')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseña -->
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
	  	
	  	<table>
 

	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
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
				<td>PERMISOS </td>
				<td>ACA VAN LOS PERMISOS</td>
			
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
	{!!link_to_route('roles.edit', $title = 'MODIFICAR', $parameters = [$role], $attributes = [])!!}
	
	
	@if($permisos)
	<div class="table-resposive">
        <div class="col-md-4 col-md-offset-4">
        <h3>Permisos asociados</h3>
	    <table class="table table-bordered table-hover table-striped">
	    @foreach($permisos as $permiso)
	    	<tr>
	    		<td>NOMBRE </td>
				<td>{{$permiso}}</td>
			</tr>
			
			@endforeach
		</table>
		</div>
		</div>
	@endif
	
	
	
@endif
@endsection
@extends('layouts.plantilla')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
<style>
<!--
.table{
	 background-color: #E3EEE9;
	 
	 
}
-->
</style>
	   @include('layouts.error')
	  	@if($user)
	  	
	  	
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-striped">
	    	<tr>
	    		<td>ID USUARIO </td>
				<td>{{$user->id}}</td>
			</tr>
			<tr>
				<td>DNI </td>
				<td>{{$user->dni}}</td>
			</tr>
			<tr>
				<td>NOMBRE </td>
				<td>{{$user->name}}</td>
			 </tr>
			 <tr>
				<td>ROL </td>
				<?php 
					$roles=$user->getRoleNames();							
				?>								
					@foreach($roles as $rol)
				<td>{{$rol}}</td>
					@endforeach
				
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{$user->created_at}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{$user->updated_at}}</td>
			</tr>			
			
		</table>
			{!!link_to_route('users.edit', $title = 'MODIFICAR', $parameters = [$user], $attributes = [])!!}
		@endif
		</div>
		</div>
@endsection
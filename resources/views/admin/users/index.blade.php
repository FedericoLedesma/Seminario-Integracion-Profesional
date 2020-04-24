@extends('layouts.plantilla')

@section('content')


<!-- mostrar una tabla con los roles que existen 
oculatar componentes segun los permisos

-->
	   
	  	<title>PAGINA PRINCIPAL ADMINISTRADOR</title>
	    
	    <h1>USUARIOS REGISTRADOS</h1>
	      @include('layouts.error')
	     
<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->
<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="css/bootstrap-theme.min.css" crossorigin="anonymous">
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
<style>
<!--
.table{
	 background-color: #E3EEE9;
	 
	 
}
-->
</style>
<form method="get" action={{ route('users.create') }}>
	
		<button class="btn btn-primary" type="submit">Agregar usuario</button>
		
	
</form>
<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
					<table class="table table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">--> 
						<thead >
							<tr>
								<th scope="col">id</th>
								<th scope="col">DNI</th>
								<th scope="col">Nombre</th>
								<th scope="col">Rol</th>
								<th scope="col">Creado</th>
								<th scope="col">Actualizado</th>
								<th scope="col">Modificar</th>
								<th scope="col">Eliminar</th>
								
							</tr>
						</thead>
					
						<tbody>
						@if($users)
							@foreach($users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->dni}}</td>
								<td>{{$user->name}}</td>
								<?php 
								$roles=$user->getRoleNames();							
								?>								
								@foreach($roles as $rol)
								<td>{{$rol}}</td>
								@endforeach
								<td>{{$user->created_at}}</td>
								<td>{{$user->updated_at}}</td>								
								<td>{!!link_to_route('users.show', $title = 'VER', $parameters = [$user], $attributes = []);!!}
								
								
								{!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method'=> 'DELETE'])!!}
								<td>{!!	Form::submit('ELIMINAR')!!}</td>
								{!! Form::close() !!}
								
							</tr>
								@endforeach
							@endif
						
						
					
					</table>
				</div>
				</div>
			  </div>
				 </div> 
				<!--</div>-->
@endsection


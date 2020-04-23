@extends('layouts.plantilla')

@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contraseña -->
<!-- mostrar una tabla con los roles que existen -->
	   
	  	<title>PAGINA PRINCIPAL ADMINISTRADOR</title>
	    
	    <h1>ROLES EXISTENTES</h1>
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
<form method="get" action={{ route('roles.create') }}>
	
		<button class="btn btn-primary" type="submit">Agregar Rol</button>
		
	
</form>
<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">--> 
						<thead >
							<tr>
								<th scope="col">id</th>
								<th scope="col">Nombre</th>						
								<th scope="col">Guard Name</th>
								<th scope="col">Creado</th>
								<th scope="col">Actualizado</th>
								<th scope="col">Ver</th>
								<th scope="col">Eliminar</th>
								
							</tr>
						</thead>
					
						<tbody>
						@if($roles)
							@foreach($roles as $role)
							<tr>
								<td>{{$role->id}}</td>
								<td>{{$role->name}}</td>
								<td>{{$role->guard_name}}</td>
								<td>{{$role->created_at}}</td>
								<td>{{$role->updated_at}}</td>
								<td>{!!link_to_route('roles.show', $title = 'VER', $parameters = [$role], $attributes = []);!!}
								{!! Form::model($role, ['route' => ['roles.destroy', $role->id], 'method'=> 'DELETE'])!!}
								
								<td>{!!	Form::submit('Borrar')!!}</td>
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


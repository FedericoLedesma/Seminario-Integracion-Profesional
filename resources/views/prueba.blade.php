@extends('layout')
@section('titulo')
	Usuarios
@endsection
@section('content')
<style>
<!--
.table{
	 background-color: #E3EEE9;
	 
	 
}
</style>
<form method="get" action={{ route('users.create') }}>
	
		<button class="btn btn-primary" type="submit">Agregar usuario</button>
		
	
</form>
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
@endsection
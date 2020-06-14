@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item active">Permisos</li>
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<!-- INDEX PERMISSION -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	  	<title>PAGINA PRINCIPAL ADMINISTRADOR</title>

	    <h1>PERMISIOS EXISTENTES</h1>
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
<form method="get" action={{ route('permisos.create') }}>

	<button class="btn btn-primary" type="submit">Agregar Permiso</button>

</form>
<div>
<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-permisos" class="alert alert-info">Roles con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>
<div class="container">

    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">

				 <div class="panel-heading">

				 {!!Form::open(['route'=>'permisos.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						 <option value="busqueda_id" >ID</option>
						 <option value="busqueda_name" >Nombre</option>
					 </select>

						 {!!	Form::text('permisoid',null,['id'=>'permisoid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
						 <div class="input-group-append">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						 </div>
					 </div>
					{!! Form::close() !!}



					<table class="table table-striped table-hover ">
						<thead >
							<tr>
								<th scope="col">id</th>
								<th scope="col">Nombre</th>
								<th scope="col">Creado</th>
							<!--	<th scope="col">Actualizado</th>
								<th scope="col">Modificar</th>-->
								<th scope="col">Eliminar</th>

							</tr>
						</thead>

						<tbody>
						@if($permisos)
							@foreach($permisos as $permission)
							<tr>
								<td>{{$permission->id}}</td>
								<td>{{$permission->name}}</td>
							  <td>{{$permission->created_at}}</td>

								{!! Form::model($permission, ['route' => ['permisos.destroy', $permission->id], 'method'=> 'DELETE'])!!}
                @if((((!($permission->id==9))&&(!($permission->id==10)))&&(!($permission->id==7)))&&(!($permission->id==8)))
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $permission->id }}">X</button></td>
                @endif
								{!! Form::close() !!}

							</tr>
								@endforeach
							@endif

						</tbody>

					</table>
				</div>
				</div>
			  </div>
				 </div>
@endsection
@section('script')
 <script src="{{asset('js/permission-script.js')}}"></script>
 	<script type="text/javascript">
 		$(document).ready(function(){
 			 document.getElementById("nav-permisos").setAttribute("class", "nav-link active");
       document.getElementById("nav-permisos-todos").setAttribute("class", "nav-link active");	
 			});
 	</script>
@endsection

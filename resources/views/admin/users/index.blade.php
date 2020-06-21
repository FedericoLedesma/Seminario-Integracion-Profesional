@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Usuarios</li>
@endsection
@section('titulo')
USUARIOS REGISTRADOS
@endsection
@section('content')

@include('layouts.error')

<form method="get" action={{ route('users.create') }}>

		<button class="btn btn-primary" type="submit">Agregar usuario</button>


</form>
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben in el todal de usuarios -->
			<!-- {{$users_total}} usuarios registrados -->
		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" class="alert alert-info">Usuarios con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

<!--<div class="container">-->
    <!--  <div class="row">-->
  <!--  <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">-->
             <!--<div class="panel panel-default">-->
		<!--		 <div class="panel-heading">

				 {!!Form::open(['route'=>'users.index','method'=>'GET']) !!}
          <div class="input-group mb-3">

          <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">

            <option value="busqueda_dni" >Número Doc.</option>
            <option value="busqueda_name" >Nombre</option>
          </select>

            {!!	Form::text('userid',null,['id'=>'userid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
            <div class="input-group-append">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
            </div>
          </div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>-->
	<!--<div class="container">-->
	    <div class="table-responsive">
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped"><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Número doc.</th>
								<th scope="col">Tipo de doc.</th>
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Rol</th>
								<th scope="col">Acción</th>

							</tr>
						</thead>
						<tbody>
						@if($users)
							@foreach($users as $user)
							<tr>
								<td>{{$user->personal->persona->numero_doc}}</td>
								<td>{{$user->personal->persona->tipoDocumento->name}}</td>
								<td>{{$user->personal->persona->name}}</td>
								<td>{{$user->personal->persona->apellido}}</td>
								<?php
								$roles=$user->getRoleNames();
								?>
								@foreach($roles as $rol)
								<td>{{$rol}}</td>
								@endforeach
								<td>{!!link_to_route('users.show', $title = 'VER', $parameters = [$user],['class' => 'btn btn-info btn-sm'], $attributes = [])!!}


                  @if(!($user->id==1))
  								<button type="submit" class="btn btn-danger btn-sm eliminar" data-token="{{ csrf_token() }}" data-id="{{ $user->id }}">Eliminar</button></td>
  								@else
									<button type="submit" class="btn btn-sm btn-danger disabled">Eliminar</button>
									@endif

							</tr>
								@endforeach
							@endif



					</table>
				</div>
	    </div>
				<!--</div>-->
@endsection
@section('script')
 	<script src="{{asset('js/user-script.js')}}"></script>
	<!-- DataTables -->
	<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			 console.log("hola");
			 document.getElementById("nav-usuarios").setAttribute("class", "nav-link active");
			 document.getElementById("nav-usuarios-todos").setAttribute("class", "nav-link active");
			});
	</script>

	<script>
 	$(function () {
 		$("#example1").DataTable({
 			"responsive": true,
 			"autoWidth": false,
 		});
 		$('#example2').DataTable({
 			"paging": true,
 			"lengthChange": false,
 			"searching": false,
 			"ordering": true,
 			"info": true,
 			"autoWidth": false,
 			"responsive": true,
 		});
 	});
  </script>
@endsection

@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item active">Permisos</li>
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="css/bootstrap-theme.min.css" crossorigin="anonymous">
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endsection
@section('titulo')
PERMISOS REGISTRADOS
@endsection
@section('content')

<!-- INDEX PERMISSION -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	  	<title>PAGINA PRINCIPAL ADMINISTRADOR</title>

	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->


<form method="get" action={{ route('permisos.create') }}>

	<button class="btn btn-primary" type="submit">Agregar Permiso</button>

</form>
<p>
  <span id="users-total">
    <!-- Aca deben ir el total de roles -->

  </span>
</p>
<div>
<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-permisos" class="alert alert-info">Roles con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>
  <div class="table-responsive">
    <div class="col-md-auto col-md-offset-2">
      <div class="panel-heading">
       <div class="card-body">
         <table id="example1" class="table table-bordered table-striped"><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Nombre</th>
								<th scope="col">Creado</th>
								<th scope="col">Eliminar</th>

							</tr>
						</thead>

						<tbody>
						@if($permisos)
							@foreach($permisos as $permission)
							<tr>
								<td>{{$permission->id}}</td>
								<td>{{$permission->name}}</td>
							  <td>{{date("d/m/Y h:i:s", strtotime($permission->created_at))}}</td>
								<td><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $permission->id }}">X</button></td>

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
 <!-- DataTables -->
 <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

 	<script type="text/javascript">
 		$(document).ready(function(){
 			 document.getElementById("nav-permisos").setAttribute("class", "nav-link active");
       document.getElementById("nav-permisos-todos").setAttribute("class", "nav-link active");
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

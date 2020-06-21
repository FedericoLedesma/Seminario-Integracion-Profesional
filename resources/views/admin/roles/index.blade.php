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
<li class="breadcrumb-item active">Roles</li>
@endsection
@section('titulo')
ROLES REGISTRADOS
@endsection
@section('content')

	  	<title>PAGINA PRINCIPAL ADMINISTRADOR</title>

	      @include('layouts.error')

<form method="get" action={{ route('roles.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Rol</button>


</form>
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-roles" class="alert alert-info">Roles con el {{$busqueda_por}} = {{$query}}</div>
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
								<th scope="col">Actualizado</th>
								<th scope="col">Acción</th>
								<th scope="col"></th>

							</tr>
						</thead>

						<tbody>
						@if($roles)
							@foreach($roles as $role)
							<tr>
								<td>{{$role->id}}</td>
								<td>{{$role->name}}</td>
								<td>@if($role->created_at){{date("d/m/Y h:i:s", strtotime($role->created_at))}}@endif</td>
								<td>@if($role->updated_at){{date("d/m/Y h:i:s", strtotime($role->updated_at))}}@endif</td>
								<td>{!!link_to_route('roles.show', $title = 'VER', $parameters = [$role],['class' => 'btn btn-info'], $attributes = [])!!}</td>

								<td>
									@if($role->id==1)
										<button type="submit" class="btn btn-danger eliminar disabled">Eliminar</button>
									@else
										<button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $role->id }}">Eliminar</button>
									@endif
								</td>


							</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
				<!--</div>-->
@endsection
@section('script')
 <script src="{{asset('js/role-script.js')}}"></script>
 <!-- DataTables -->
 <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

 	<script type="text/javascript">
 		$(document).ready(function(){
 			 document.getElementById("nav-roles").setAttribute("class", "nav-link active");
 			 document.getElementById("nav-roles-todos").setAttribute("class", "nav-link active");
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

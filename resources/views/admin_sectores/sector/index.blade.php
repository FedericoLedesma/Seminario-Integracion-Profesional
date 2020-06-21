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
	<li class="breadcrumb-item active">Sectores</li>
@endsection
@section('titulo')
	SECTORES REGISTRADOS
@endsection
@section('content')

	      @include('layouts.error')

<form method="get" action={{ route('sectores.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Sector</button>

</form>
<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de Sectores -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-sector" class="alert alert-info">Sectores con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>


<div class="table-responsive">
	<div class="col-md-auto col-md-offset-2">
	 	<div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead >
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col">Descripción</th>
						<th scope="col">Cantidad de habitaciones</th>
						<th scope="col">Acción</th>

					</tr>
				</thead>

				<tbody>
				@if($sectores)
					@foreach($sectores as $sector)
					<tr>
						<td>{{$sector->name}}</td>
						<td>{{$sector->descripcion}}</td>
						<td>{{count($sector->get_habitaciones())}}</td>
						<td>{!!link_to_route('sectores.show', $title = 'Ver', $parameters = [$sector],['class' => 'btn btn-info'], $attributes = [])!!}

					<button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $sector }}">Eliminar</button></td>


					</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection
@section('script')
	<script src="{{asset('js/sector-script.js')}}"></script>
	<!-- DataTables -->
	<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

	<script type="text/javascript">
	$(document).ready(function(){
	   document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
	   document.getElementById("nav-administracion-sectores").setAttribute("class", "nav-link active");
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

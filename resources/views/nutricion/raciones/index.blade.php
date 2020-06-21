@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Raciones</li>
@endsection
@section('titulo')
	RACIONES REGISTRADAS
@endsection
@section('content')

	@include('layouts.error')


<form method="get" action={{ route('raciones.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Ración</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de personas -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-raciones" class="alert alert-info">Raciones con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>
		<div class="table-responsive">
	  	<div class="col-md-auto col-md-offset-2">
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped"><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Observación</th>
								<th scope="col">Alimentos</th>
								<th scope="col">Acción</th>

							</tr>
						</thead>

						<tbody>
						@if($raciones)
							@foreach($raciones as $racion)
							<tr>
								<td>{{$racion->name}}</td>
								<td>{{$racion->observacion}}</td>
								<td>
									@if(count($racion->racion_alimentos)>0)
										@foreach($racion->alimentos as $alimento)
									  	{{$alimento->name}} ({{$alimento->pivot->cantidad}} @if($racion->racion_alimento($alimento->id)->unidad){{$racion->racion_alimento($alimento->id)->unidad->name}}@endif)</br>
										@endforeach
									@endif
								</td>
								<td>{!!link_to_route('raciones.show', $title = 'Ver', $parameters = [$racion->id],['class' => 'btn btn-info'], $attributes = [])!!}
								<button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $racion }}">Eliminar</button></td>


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
 <script src="{{asset('js/racion-script.js')}}"></script>
 <!-- DataTables -->
 <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <script type="text/javascript">
   	$(document).ready(function(){
   		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
   		document.getElementById("nav-raciones").setAttribute("class","nav-link active");
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

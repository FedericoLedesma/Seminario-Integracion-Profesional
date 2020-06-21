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
	<li class="breadcrumb-item active">Alimentos</li>
@endsection
@section('titulo')
 ALIMENTOS REGISTRADOS
@endsection
@section('content')


 	@include('layouts.error')

<form method="get" action={{ route('alimentos.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Alimento</button>

</form>
<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de Alimentos -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-alimento" class="alert alert-info">Alimentos con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>


  <div class="table-responsive">
		<div class="panel-heading">
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped"><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
					<thead >
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Acción</th>
						</tr>
					</thead>
					<tbody>
						@if($alimentos)
							@foreach($alimentos as $alimento)
							<tr>
								<td>{{$alimento->name}}</td>
								<td>{!!link_to_route('alimentos.show', $title = 'VER', $parameters = [$alimento],['class' => 'btn btn-info'], $attributes = [])!!}
									<button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $alimento }}">Eliminar</button>
								</td>
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
 <script src="{{asset('js/alimento-script.js')}}"></script>
 <!-- DataTables -->
 <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

 <script type="text/javascript">
 	$(document).ready(function(){
 		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
 		document.getElementById("nav-alimentos").setAttribute("class","nav-link active");
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

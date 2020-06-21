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
<li class="breadcrumb-item active">Personas</li>
@endsection
@section('titulo')
PERSONAS REGISTRADAS
@endsection
@section('content')

	@include('layouts.error')
<form method="get" action={{ route('personas.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Persona</button>


</form>
<div>
	<p>
		<span id="personas-total">
			<!-- Aca deben ir el total de personas -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-personas" class="alert alert-info">Personas con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>



<!--	<div class="table-responsive">
  	<div class="col-md-8 col-md-offset-2">
 			<div class="panel-heading">
				 {!!Form::open(['route'=>'personas.index','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">

						 <option value="busqueda_name" >Nombre</option>
						 <option value="busqueda_apellido" >Apellido</option>
						 <option value="busqueda_dni" >Número doc.</option>
					 </select>

						 {!!	Form::text('personaid',null,['id'=>'personaid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
						 <div class="input-group-append">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						 </div>
					 </div>
					{!! Form::close() !!}
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">DataTable with default features</h3>
				</div>-->
				<!-- /.card-header -->
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped"><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Número Doc.</th>
								<th scope="col">Tipo Doc.</th>
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Fecha Nac.</th>
								<th scope="col">EMail</th>
								<th scope="col">Acción</th>								

							</tr>
						</thead>

						<tbody>
						@if($personas)
							@foreach($personas as $persona)
							<tr>
								<td>{{$persona->numero_doc}}</td>
								<td>{{$persona->tipoDocumento->name}}</td>
								<td>{{$persona->name}}</td>
								<td>{{$persona->apellido}}</td>
								<td>{{$persona->fecha_nac()}}</td>
								<td>{{$persona->email}}</td>
								<td>{!!link_to_route('personas.show', $title = 'Ver', $parameters = [$persona],['class' => 'btn btn-info'], $attributes = [])!!}
									<button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $persona }}">Eliminar</button>
								</td>
							</tr>
								@endforeach
							@endif

					</table>
			</div>
		</div>
	<!--</div>-->


@endsection
@section('script')
 <script src="{{asset('js/persona-script.js')}}"></script>
 <!-- DataTables -->
 <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
 <!-- AdminLTE App -->
 <script type="text/javascript">
  $(document).ready(function(){
    document.getElementById("nav-personas").setAttribute("class", "nav-link active");
    document.getElementById("nav-personas-todas").setAttribute("class", "nav-link active");
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

@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Personal del hospital</title>
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endsection
@section('navegacion')
<li class="breadcrumb-item active">Personal</li>
@endsection
@section('titulo')
PERSONAL REGISTRADO
@endsection
@section('content')

	@include('layouts.error')

	<a href="{{action('PersonalController@create')}}" class="btn btn-primary">Ingresar nuevo personal</a>
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($notificacion)
		<div id="alert" name="alert-roles" class="alert alert-info">{{$notificacion}}</div>
	@endif
</div>


  <div class="table-responsive">
    <div class="col-md-auto col-md-offset-2">
			<div class="panel-heading">
				{!!	Form::label('titulo_tabla', 'Personal del hospital')!!}
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead >
							<tr>

								<th scope="col">Nombre</th>
								<th scope="col">Documento</th>
								<th scope="col">Sector</th>
								<th scope="col">Acción</th>

							</tr>
						</thead>

						<tbody>
						@if($personales)
							@foreach($personales as $personal)
							<tr>
								<td>{{$personal->get_name()}} {{$personal->get_apellido()}}</td>
								<td>{{$personal->get_tipo_documento_name()}} {{$personal->get_numero_doc()}}</td>
								<td>{{$personal->get_sector_name()}}</td>
								<td>{!!link_to_route('personal.show', $title = 'Ver', $parameters = [$personal],['class' => 'btn btn-info'], $attributes = [])!!}

									<button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $personal }}">Eliminar</button></td>

							</tr>
								@endforeach
							@endif

					</table>
				</div>
			</div>
		</div>

@endsection
@section('script')
 <script src="{{asset('js/personal-script.js')}}"></script>
 <!-- DataTables -->
 <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

 <script type="text/javascript">
  $(document).ready(function(){
     document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
     document.getElementById("nav-administracion-personal").setAttribute("class", "nav-link active");
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

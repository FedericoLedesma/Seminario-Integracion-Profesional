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

	<!--<a href="{{action('PersonalController@create')}}" class="btn btn-primary">Ingresar nuevo personal</a>-->
	  <a href="" data-toggle="modal" data-target="#modal" class="btn btn-primary">Ingresar nuevo personal </a>
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
	</div>

	<div class="modal fade" id="modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" id="modal-movimiento-header">
					<h4>Registrar nuevo personal</h4>
					<button type="button" class="close" data-dismiss="modal">
						<span>×</span>
					</button>
				</div>
				  {!!Form::open(['method'=>'get','action'=>'PersonalController@ingresarNuevo'])!!}
				<div class="modal-body">
							<div class="row">
								<div class="col-sm-6">
									<!-- text input -->
									<div class="form-group">
										<label>Número de documento</label>
										<input id="numero_doc"  class="form-control" name="numero_doc" type="number" min="1000000" max="999999999" required></input>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Tipo de doc.</label>
										@if($tipos_documentos)
											<select name="tipo_documento_id" class="browser-default custom-select">
												@foreach ($tipos_documentos as $tipos_documento)
												<option value="{{$tipos_documento->id}}" >{{$tipos_documento->name}}</option>
												@endforeach
										 </select>
									 @endIf
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<!-- text input -->
									<div class="form-group">
										<label>Apellidos</label>
										<input type="text" name="apellido" class="form-control" placeholder="Apellidos ..." required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Nombres</label>
										<input type="text" name="name" class="form-control" placeholder="Nombres ..." required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" class="form-control" placeholder="Email (opcional) ..." required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Domicilio</label>
										<input type="text" name="direccion" class="form-control" placeholder="Domicilio ..." required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<!-- text input -->
									<div class="form-group">
										<label>Localidad</label>
										<input type="text" name="localidad" class="form-control" placeholder="Localidad ..." required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Provincia</label>
										<input type="text" name="provincia" class="form-control" placeholder="Provincia ..." required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<!-- text input -->
									<div class="form-group">
										<label>Sexo</label>
										<input type="text" name="sexo" class="form-control" placeholder="Sexo ..." required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Fecha de Nacimiento</label>
										<input id="fecha_nac" class="form-control" name="fecha_nac" type="date" required value="{{\Carbon\Carbon::now()->toDateString()}}"></input>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<!-- text input -->
									<div class="form-group">
										<label>Sector</label>
										<select class="browser-default custom-select sectores" id="sectores-modal" name="sectores" required>
											@if($sectores)
												@foreach($sectores as $sector)
													@if(count($sector->get_habitaciones_disponibles())>0)
													<option value= {{$sector->get_id()}}>{{$sector->get_name()}}</option>
													@endif
												@endforeach
											@endif
										</select>
									</div>
								</div>
							</div>
				</div>
				<div class="modal-footer">
					 {!!	Form::submit('Registrar',['class' => 'btn btn-success'])!!}
					{!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
				</div>
				{!! Form::close() !!}
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

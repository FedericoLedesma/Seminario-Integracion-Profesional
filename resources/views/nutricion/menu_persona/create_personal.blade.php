@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
	div.blueTable {
	  width: 100%;
	  text-align: left;
	}
	.divTable.blueTable .divTableCell, .divTable.blueTable .divTableHead {
	  border: 0px solid #AAAAAA;
	  padding: 10px 0px;
	}
	.divTable.blueTable .divTableBody .divTableCell {
	  font-size: 15px;
		text-align: center;
	}
	.divTable.blueTable .divTableRow:nth-child(even) {
	  background: #D4DAED;
	}
	.divTable.blueTable .divTableHeading {
		border-bottom: 2px solid #444444;
	  }
	.divTable.blueTable .divTableHeading .divTableHead {
	  font-size: 16px;
	  font-weight: bold;
	  color: #01030B;
		text-align: center;
		border-bottom: 2px solid #444444;
	}
	.blueTable .tableFootStyle {
	  font-weight: bold;
	  color: #FFFFFF;
	}
	.blueTable .tableFootStyle .links {
		 text-align: right;
	}
	.blueTable .tableFootStyle .links a{
	  display: inline-block;
	  background: #1C6EA4;
	  color: #FFFFFF;
	  padding: 2px 8px;
	  border-radius: 5px;
	}
	.blueTable.outerTableFooter {
	  border-top: none;
	}
	.blueTable.outerTableFooter .tableFootStyle {
	  padding: 3px 5px;
	}
	/* DivTable.com */
	.divTable{ display: table; }
	.divTableRow { display: table-row; }
	.divTableHeading { display: table-header-group;}
	.divTableCell, .divTableHead { display: table-cell;}
	.divTableHeading { display: table-header-group;}
	.divTableFoot { display: table-footer-group;}
	.divTableBody { display: table-row-group;}
</style>
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('navegacion')
<li class="breadcrumb-item"><a href="{{route('menu_persona.index') }}">Menús</a></li>
<li class="breadcrumb-item active">Crear menús a Personal</li>
@endsection
@section('titulo')
Crear menús para Personal
@endsection
@section('content')
 	@include('layouts.error')
<div>
	<p>
		<span id="users-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-raciones" class="alert alert-info">Busqueda por: {{$busqueda_por}} {{$query}}</div>
	@endif
</div>

<!---<div class="container">
  <div class="table-responsive">
		<div class="col-md-8 col-md-offset-1">

			<div class="panel-heading">
				{!!Form::open(['route'=>'menu_persona.create_personal','method'=>'GET']) !!}
		 			<div class="input-group mb-3">

					  <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
					 		<option value="busqueda_name" >Nombre y/o apellido</option>
						 	<option value="busqueda_dni" > Número DNI </option>
						 	<option value="busqueda_sector" > Sector </option>
					 	</select>

						{!!	Form::text('paciente_id',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
							<div class="input-group-append">
								{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						 	</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

	<div class="table-responsive">
		<div class="col-md-auto col-md-offset-1">
      <div class="panel-heading">
        <div class="divTable blueTable">
          <div class="divTableHeading">
            <div class="divTableRow">
							<div class="divTableHead">Nombre</div>
							<div class="divTableHead">Apellido</div>
							<div class="divTableHead">Tipo Doc.</div>
							<div class="divTableHead">Número de doc.</div>
              <div class="divTableHead">Sector</div>
							<div class="divTableHead">Acción</div>
							<div class="divTableHead"></div>

            </div>
          </div>

					<div class="divTableBody">
						@if($personal)
							@foreach($personal as $p)
								<div class="divTableRow">
									<div class="divTableCell">{{$p->persona->name}}</div>
									<div class="divTableCell">{{$p->persona->apellido}}</div>
									<div class="divTableCell">{{$p->persona->tipoDocumento->name}}</div>
									<div class="divTableCell">{{$p->persona->numero_doc}}</div>
                  @if($p->persona->sectorFecha(date("Y-m-d")))
										<div class="divTableCell">{{$p->persona->sectorFecha(date("Y-m-d"))->name}}</div>
									@else
										<div class="divTableCell">-</div>
									@endif
									<div class="divTableCell"><a href="#" class="btn btn-primary pull-right crear_menu" data-paciente="{{$p}}" data-paciente_name="{{$p->persona->name}}" data-paciente_apellido="{{$p->persona->apellido}}" data-patologias="{{$p->persona->patologias}}" data-toggle="modal" data-target="#create">
									    Crear menú
									</a></div>
								</div>
							@endforeach
						@endif

          </div>
        </div>
			</div>
		</div>
	</div>-->
	<div class="card-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead >
				<tr>
					<th scope="col">Apellido</th>
					<th scope="col">Nombre</th>
					<th scope="col">Numero Doc.</th>
					<th scope="col">Tipo doc. </th>
					<th scope="col">Sector</th>
					<th scope="col">Acción</th>
				</tr>
			</thead>

			<tbody>
				@if($personal)
					@foreach($personal as $p)
					<tr>
						<td>{{$p->persona->apellido}}</td>
						<td>{{$p->persona->name}}</td>
						<td>{{$p->persona->numero_doc}}</td>
						<td>{{$p->persona->tipoDocumento->name}}</td>
						@if($p->persona->sectorFecha(date("Y-m-d")))
							<td>{{$p->persona->sectorFecha(date("Y-m-d"))->name}}</td>
						@else
							<td>-</td>
						@endif
						<td><a href="#" class="btn btn-primary pull-right crear_menu" data-paciente="{{$p}}" data-paciente_name="{{$p->persona->name}}" data-paciente_apellido="{{$p->persona->apellido}}" data-patologias="{{$p->persona->patologias}}" data-toggle="modal" data-target="#create">
								Crear menú
						</a></td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>

@if($personal)
	<div class="modal fade" id="create">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header" id="modal-header">

						</div>
						<div class="modal-body" id="modal-body">
							<div id="p_body">

							</div>
							<div id="alert-modal" class="alert alert-modal alert-danger"></div>
							<div class="row">
								<div class="col-sm-5">
									<!-- text input -->
									<div class="form-group">
										{!!	Form::label('hor_id', 'Horario')!!}
										<select class="browser-default custom-select" data-paciente="{{$p}}" id="horario_id" name="horario_id">
											<option selected value= 0> Seleccione horario </option>
										</select>
									</div>
								</div>
								<div class="col-sm-7">
									<div class="form-group">
										{!!	Form::label('racion_id', 'Raciones disponibles')!!}
										<select class="browser-default custom-select" id="racion_id" name="racion_id">
											<option value= 0>Raciones recomendadas</option>
										</select>
									</div>
								</div>
								<p class="ml-2">(*) Ración recomendada.</p>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>	
							<a href ="{{ route('raciones.create') }}" class="btn btn-primary" target="_blank">Nueva Ración</a>
							<a href="" class="btn btn-success guardar_menu" >Guardar</a>	
						</div>

				</div>
		</div>
	</div>
@endif
@endsection
@section('script')
	<script src="{{asset('js/menu_persona-script.js')}}"></script>
	<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

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

  <script type="text/javascript">
   $(document).ready(function(){
		 	document.getElementById("nav-nutricion").setAttribute("class", "nav-link active");
      document.getElementById("nav-menus").setAttribute("class", "nav-link active");
     });
  </script>

@endsection

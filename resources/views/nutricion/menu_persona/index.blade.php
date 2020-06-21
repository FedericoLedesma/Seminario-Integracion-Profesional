@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Menú persona</title>
<style>
	div.blueTable {
	border: 1px solid #1C6EA4;
	background-color: #EEEEEE;
	width: 100%;
	text-align: left;
	border-collapse: collapse;
	}
	.divTable.blueTable .divTableCell, .divTable.blueTable .divTableHead {
	border: 1px solid #AAAAAA;
	padding: 3px 2px;
	}
	.divTable.blueTable .divTableBody .divTableCell {
	font-size: 13px;
	}
	.divTable.blueTable .divTableRow:nth-child(even) {
	background: #CBCFD5;
	}
	.divTable.blueTable .divTableHeading {
	background: #1C6EA4;
	background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
	background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
	background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
	border-bottom: 2px solid #444444;
	}
	.divTable.blueTable .divTableHeading .divTableHead {
	font-size: 15px;
	font-weight: bold;
	color: #FFFFFF;
	border-left: 2px solid #D0E4F5;
	}
	.divTable.blueTable .divTableHeading .divTableHead:first-child {
	border-left: none;
	}

	.blueTable .tableFootStyle {
	font-size: 14px;
	font-weight: bold;
	color: #FFFFFF;
	background: #D0E4F5;
	background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
	background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
	background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
	border-top: 2px solid #444444;
	}
	.blueTable .tableFootStyle {
	font-size: 14px;
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
	float:left;
	}
	.divTable{ display: table; }
	.divTableRow { display: table-row; }
	.divTableHeading { display: table-header-group;}
	.divTableCell, .divTableHead { display: table-cell;}
	.divTableHeading { display: table-header-group;}
	.divTableFoot { display: table-footer-group;}
	.divTableBody { display: table-row-group;}
	th{
	font-size: 14px;
	}
	td{
	font-size: 14px;
	}
</style>
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

@endsection
@section('navegacion')
	<li class="breadcrumb-item active">Menús</li>
@endsection
@section('titulo')
MENÚS DE PERSONAS (PLANILLAS)
@endsection
@section('content')

 @include('layouts.error')


<container justify-content="space-evenly">
	<a href="{{action('MenuPersonaController@create')}}" class="btn btn-primary">Agregar menú a Pacientes (planilla)</a>
	<a href="{{route('menu_persona.create_personal')}}" class="btn btn-primary">Agregar menú Personal (planilla)</a>
	<a href="{{action('InformeController@index')}}" class="btn btn-primary">Informes</a>

</container>
<div>
	<p>
		<span id="menu_persona-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-raciones" class="alert alert-info">Menús por: {{$busqueda_por}} {{$query}}</div>
	@endif
</div>

{!!Form::open(['route'=>'menu_persona.index','method'=>'GET']) !!}
<div class="container">
  <div class="table-responsive">
		<div class="col-md-auto col-md-offset-1">
      <div class="divTable blueTable">
        <div class="divTableHeading">
          <div class="divTableRow">
						<div class="divTableHead">Fecha <label id="desde">desde</label></div>
            <div class="divTableHead" id="fecha_hasta_title">Fecha Hasta</div>
						<div class="divTableHead">Tipo Persona</div>
						<div class="divTableHead">Horarios  </div>
						<div class="divTableHead">Nombre Sector</div>
						<div class="divTableHead">N. habitación</div>

          </div>
        </div>
        <div class="divTableBody">
          <div class="divTableRow">
						<div class="divTableCell">{!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha']);!!}</div>
            <div class="divTableCell" id="fecha_hasta">{!!Form::date('fecha_hasta', \Carbon\Carbon::now(),['id'=>'fecha']);!!}</div>
						<div class="divTableCell">
						<select class="browser-default custom-select" id="busqueda_persona_por" name="busqueda_persona_por">
							<option value="busqueda_todos" >Todos</option>
							<option value="busqueda_pacientes">Pacientes</option>
							<option value="busqueda_personal">Personal</option>
						</select>
						</div>
						<div class="divTableCell">
							<select class="browser-default custom-select" id="busqueda_horario_por" name="busqueda_horario_por">
								<option value="0" >Todos</option>
								@if($horarios)
									@foreach($horarios as $horario)
										<option value="{{$horario->id}}" >{{$horario->name}}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="divTableCell">
							{!!	Form::text('sector_name',null,['id'=>'sector_name','class'=>'form-control','name'=>'search','placeholder'=>'Todos los sectores'])!!}
						</div>
						<div class="divTableCell">
							{!!	Form::number('habitacion_id',null,['id'=>'habitacion_id','class'=>'form-control','name'=>'search_habitacion'])!!}
						</div>

          </div>

					<div class="divTableRow">
            <div class="divTableCell">
              <input type="checkbox" name="buscar_desde_hasta" value="true" id="checkbox_fecha" />Incluir desde - hasta<br />
            </div>
            <div class="divTableCell">
							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
						</div>
					</div>

				</div>
  				{!! Form::close() !!}
      </div>
		</div>
	</div>
</div>


			<div class="col-md-auto">
				<div class="card-body">
					<table id="example2" class="table table-bordered table-striped"><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Persona</th>
								<th scope="col">Sector </th>
	              <th scope="col">Habitación</th>
	              <th scope="col">Cama</th>
								<th scope="col">Horario</th>
								<th scope="col">Ración</th>
								<th scope="col">Fecha</th>
								<th scope="col">Realizado</th>
								<th scope="col">Acción</th>						

							</tr>
						</thead>

						<tbody>
						@if($menus)
							@foreach($menus as $menu_persona)
							<tr>
								{{Log::debug(' Persona id: '.$menu_persona)}}
								<td>{{$menu_persona->get_persona_nombre_completo()}}</td>
								@if($menu_persona->persona->sectorFecha($menu_persona->racionDisponible->fecha))
	                <td>{{$menu_persona->persona->sectorFecha($menu_persona->racionDisponible->fecha)->name}}</td>
	              @else
	                <td>-</td>
	              @endif
	              @if($menu_persona->persona->habitacionFecha($menu_persona->racionDisponible->fecha))
	                <td>{{$menu_persona->persona->habitacionFecha($menu_persona->racionDisponible->fecha)->name}}</td>
								@else
	                <td>-</td>
								@endif
								@if($menu_persona->persona->camaFecha($menu_persona->racionDisponible->fecha))
	                <td>{{$menu_persona->persona->camaFecha($menu_persona->racionDisponible->fecha)->id}}</td>
	              @else
	                <td>-</td>
	              @endif
								<td>{{$menu_persona->get_horario_name()}}</td>
								<td>{{$menu_persona->get_racion_name()}}</td>
								<td>{{$menu_persona->racionDisponible->fecha()}}</td>
								<td>{{$menu_persona->isRealizado_str()}}</td>
								@if($menu_persona->realizado)
								<td><button type="submit" class="btn btn-success btn-sm entregar"  disabled>Entregar</button>
								<button type="submit" class="btn btn-danger btn-sm eliminar" disabled>Eliminar</button></td>
								@else
								<td><button type="submit" class="btn btn-success btn-sm entregar" id="btn-{{$menu_persona->id}}" data-token="{{ csrf_token() }}" data-id="{{ $menu_persona }}">Entregar</button>
								<button type="submit" class="btn btn-danger btn-sm eliminar" id="btn-eliminar-{{$menu_persona->id}}" data-token="{{ csrf_token() }}" data-id="{{ $menu_persona }}">Eliminar</button></td>
								@endif

							{!! Form::close() !!}
							</tr>
							@endforeach
						@endif

					</table>
			</div>
		</div>



@endsection
@section('script')
  <script src="{{asset('js/menu_persona-script.js')}}"></script>

	<!-- DataTables -->
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

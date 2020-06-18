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

<div class="container">
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
<div class="container">
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
	</div>
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
							<table>
								<tr>
									<td>
									{!!	Form::label('hor_id', 'Horario')!!}
									<select class="browser-default custom-select" data-paciente="{{$p}}" id="horario_id" name="horario_id">
										<option selected value= 0> Seleccione horario </option>
										@foreach($horarios as $horario)
										<option value= {{$horario->id}} >{{$horario->name}}</option>
										@endforeach
									</select>
									</td>
									<td>
										{!!	Form::label('racion_id', 'Raciones Recomendadas')!!}
										<select class="browser-default custom-select" id="racion_id" name="racion_id">
											<option value= 0>Raciones recomendadas</option>
										</select>
									</td>
								</tr>
							</table>

						</div>
						<div class="modal-footer">
								<a href ="{{ route('raciones.create') }}" class="btn btn-primary" target="_blank">Nueva Racion</a>
								<a href="" class="btn btn-success guardar_menu" >Guardar</a>
						</div>

				</div>
		</div>
	</div>
@endif
@endsection
@section('script')
	<script src="{{asset('js/menu_persona-script.js')}}"></script>

  <script type="text/javascript">
   $(document).ready(function(){
		 	document.getElementById("nav-nutricion").setAttribute("class", "nav-link active");
      document.getElementById("nav-menus").setAttribute("class", "nav-link active");
     });
  </script>

@endsection

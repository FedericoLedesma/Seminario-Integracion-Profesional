@extends('layouts.layout')
@section('token')
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  </style>
@endsection
@section('navegacion')
<li class="breadcrumb-item"><a href="{{route('menu_persona.index') }}">Menús</a></li>
<li class="breadcrumb-item active">Informes de menús</li>
@endsection
@section('titulo')
Informes de menús
@endsection
@section('content')
{!!Form::open(['route'=>'informe.generar-informe','method'=>'POST','target'=>"_blank"]) !!}
<div class="container">
  <div class="table-responsive">
		<div class="col-md-10 col-md-offset-1">
      <div class="divTable blueTable">
        <div class="divTableHeading">
          <div class="divTableRow">
								<div class="divTableHead">Fecha <label id="desde">desde</label></div>
                <div class="divTableHead" id="fecha_hasta_title">Fecha Hasta</div>
								<div class="divTableHead">Tipo de persona</div>
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
                  <input type="checkbox" name="solo_raciones" value="true" id="checkbox_fecha" /> Informe solo de raciones<br />
                </div>
                <div class="divTableCell">
									{!!	Form::submit('Generar Informe',['class'=>'btn btn-success btn-buscar'])!!}
								</div>
							</div>

						</div>
    				{!! Form::close() !!}
          </div>
				</div>
				</div>
			</div>

@endsection
@section('script')
  <script type="text/javascript">
   $(document).ready(function(){
      document.getElementById("nav-nutricion").setAttribute("class", "nav-link active");
      document.getElementById("nav-menus").setAttribute("class", "nav-link active");
     });
  </script>
@endsection

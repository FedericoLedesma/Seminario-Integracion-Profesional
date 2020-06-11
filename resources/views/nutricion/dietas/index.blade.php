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
	<li class="breadcrumb-item active">Dietas</li>
@endsection
@section('content')

	<h1>Dietas registrados</h1>
	 @include('layouts.error')

<div>
	<p>
		<span id="alimentos-total">
			<!-- Aca deben ir el total de Alimentos -->
		</span>
	</p>
	@if($query)
		<div id="alert" name="alert-dieta" class="alert alert-info">Dietas con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>

{!!Form::open(['route'=>'dietas.index','method'=>'GET']) !!}
<div class="container">
  <div class="table-responsive">
		<div class="col-md-10 col-md-offset-1">
			{!!Form::open(['route'=>'raciones.index','method'=>'GET']) !!}
				<div class="input-group mb-3">
					<select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
						<option value="busqueda_id" >ID</option>
						<option value="busqueda_name" >Nombre</option>
					</select>
					{!!	Form::text('racionid',null,['id'=>'racionid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
					<div class="input-group-append">
					 {!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
					</div>
				</div>
			 {!! Form::close() !!}
		</div>
	</div>
</div>
<div class="col-md-10 col-md-offset-2">
	<div class="table-responsive">
		<!--<div class="table table-striped table-hover ">  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
		<div class="divTable blueTable">
			<div class="divTableHeading">
				<div class="divTableRow">
						<div class="divTableHead">ID</div>
						<div class="divTableHead">Observación</div>
						<div class="divTableHead">Patología</div>
						<div class="divTableHead">Accion</div>
					</div>
				</div>

				@if($dietas)
					@foreach($dietas as $dieta)
				<div class="divTableBody">
					<div class="divTableRow">
							<div class="divTableCell">{{$dieta->id}}</div>
							<div class="divTableCell">{{$dieta->observacion}}</div>
							<div class="divTableCell">{{$dieta->patologia->name}}</div>

							<div class="divTableCell">{!!link_to_route('dietas.show', $title = 'VER', $parameters = [$dieta],['class' => 'btn btn-info'], $attributes = [])!!}
						</a><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $dieta }}">Eliminar</button>
						</div>
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>
@endsection

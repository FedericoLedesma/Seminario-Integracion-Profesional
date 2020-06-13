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
	<li class="breadcrumb-item active">Planillas</li>
@endsection
@section('content')

	  	<title>Menu persona</title>

	    <h1>Menús consumidos </h1>
	      @include('layouts.error')

<div>
	@if($query)
		<div id="alert" name="alert-raciones" class="alert alert-info">Menús consumidos: {{$busqueda_por}} {{$query}}</div>
	@endif
</div>
	<div class="container">
	  <div class="table-responsive">
			<div class="col-md-11 col-md-offset-2">
				<div class="panel-heading">
					<div class="divTable blueTable">
		        <div class="divTableHeading">
		          <div class="divTableRow">
								<div class="divTableHead">Horario</div>
								<div class="divTableHead">Ración</div>
								<div class="divTableHead">Fecha</div>
							</div>
						</div>
						<div class="divTableBody">
							@if($menus)
								@foreach($menus as $menu_persona)
									<div class="divTableRow">
										{{Log::debug(' Persona id: '.$menu_persona)}}
										<div class="divTableCell">{{$menu_persona->racionDisponible->horario_racion->racion->name}}</div>
										<div class="divTableCell">{{$menu_persona->get_horario_name()}}</div>
										<div class="divTableCell">{{$menu_persona->get_racion_name()}}</div>
									</div>
							@endforeach
						@endif
					</div>
			</div>
		</div>
	</div>
</div>

@endsection

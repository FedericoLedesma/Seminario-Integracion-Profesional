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
	}
	.divTable.blueTable .divTableRow:nth-child(even) {
	  background: #D4DAED;
	}
	.divTable.blueTable .divTableHeading {
	  }
	.divTable.blueTable .divTableHeading .divTableHead {
	  font-size: 16px;
	  font-weight: bold;
	  color: #01030B;
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
	<li class="breadcrumb-item active">Dietas</li>
@endsection
@section('titulo')
DIETAS REGISTRADAS
@endsection
@section('content')
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
		<div class="col-md-8 col-md-offset-1">
			{!!Form::open(['route'=>'raciones.index','method'=>'GET']) !!}
				<div class="input-group mb-3">
					<select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
					
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
<div class="col-md-auto col-md-offset-2">
	<div class="table-responsive">
		<!--<div class="table table-striped table-hover ">  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
		<div class="divTable blueTable">
			<div class="divTableHeading">
				<div class="divTableRow">
						<div class="divTableHead">Observación</div>
						<div class="divTableHead">Patología</div>
						<div class="divTableHead">Accion</div>
					</div>
				</div>

				@if($dietas)
					@foreach($dietas as $dieta)
				<div class="divTableBody">
					<div class="divTableRow">
							<div class="divTableCell">{{$dieta->observacion}}</div>
							<div class="divTableCell">{{$dieta->patologia->name}}</div>
							<div class="divTableCell">{!!link_to_route('dietas.show', $title = 'VER', $parameters = [$dieta],['class' => 'btn btn-info'], $attributes = [])!!}

						</div>
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
		document.getElementById("nav-dietas").setAttribute("class","nav-link active");
		});
</script>
@endsection

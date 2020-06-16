@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
	div.blueTable {
	  width: 150%;
	  height: 280;
	  text-align: left;
	}
	.divTable.blueTable .divTableCell, .divTable.blueTable .divTableHead {
	  border: 0px solid #AAAAAA;
	  padding: 18px 2px;
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
	  padding: 3px 10px;
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
	<li class="breadcrumb-item active">Movimientos</li>
@endsection
@section('titulo')
MOVIMIENTOS REGISTRADOS
@endsection
@section('content')
@include('layouts.error')
@if($query)
	<div id="alert" name="alert-raciones" class="alert alert-info">Movimientos por: {{$busqueda_por}} {{$query}}</div>
@endif
<div class="container">
	<div class="table-responsive">
  	<div class="col-md-9 col-md-offset-1">
			<div class="panel-heading">
				 {!!Form::open(['route'=>'movimientos.index','method'=>'GET']) !!}
					<div class="input-group mb-3">
					 	<table class="table table-striped table-hover ">
						 	<thead>
						 		<tr>
									<th scope="col">Fecha</th>
									<th scope="col">Horarios</th>
									<th scope="col">Nombre de ración</th>
									<th scope="col"></th>
								</tr>
						 	</thead>
						 <tbody>
							 <tr>
								 <td>{!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha']);!!}</td>
								 <td>
								 <select class="browser-default custom-select" id="busqueda_horario_por" name="busqueda_horario_por">
									 <option value="0" >Todos</option>
									 @if($horarios)
										 @foreach($horarios as $horario)
											 <option value="{{$horario->id}}" >{{$horario->name}}</option>
										 @endforeach
									 @endif
								 </select>
								 </td>
								 <td>{!!Form::text('racion_name',null,['id'=>'racion_name','class'=>'form-control','name'=>'racion_name','placeholder'=>'Ingrese el nombre de racion'])!!}</td>
								 <td>
									 {!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
								 </td>
							 </tr>
						 </tbody>
					 	</table>
					</div>
					{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
<div class="col-md-auto col-md-offset-2">
	<div class="table-responsive">
		<!--<div class="table table-striped table-hover ">  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
		<div class="divTable blueTable">
			<div class="divTableHeading">
				<div class="divTableRow">
							<div class="divTableHead">Ración</div>
							<div class="divTableHead">Horario</div>
							<div class="divTableHead">Fecha</div>
							<div class="divTableHead">Fecha Mov.</div>
							<div class="divTableHead">Tipo de Mov.</div>
							<div class="divTableHead">Cantidad</div>
							<div class="divTableHead">ID Personal Responsable</div>


							</div>
						</div>

						<div class="divTableBody">
						@if($movimientos)
							@foreach($movimientos as $movimiento)
							<div class="divTableRow">
								<div class="divTableCell">
									<a href="" data-toggle="modal" data-target="#modal-{{$movimiento->id}}">{{$movimiento->racion_disponible->horario_racion->racion->name}} </a>
								</div>
								<div class="divTableCell">{{$movimiento->racion_disponible->horario_racion->horario->name}}</div>
								<div class="divTableCell">{{$movimiento->racion_disponible->fecha()}}</div>
								<div class="divTableCell">{{$movimiento->creado}}</div>
								<div class="divTableCell">{{$movimiento->tipoMovimiento->name}}</div>
								<div class="divTableCell">{{$movimiento->cantidad}}</div>
								<div class="divTableCell">
									<a href="/personas/{{$movimiento->personal->id}}">{{$movimiento->personal->id}} - {{$movimiento->personal->persona->apellido}}  </a>
								</div>
								<div class="modal fade" id="modal-{{$movimiento->id}}">
									<div class="modal-dialog">
		                <div class="modal-content">
		                  <div class="modal-header" id="modal-movimiento-header">							
												<h4>Ración disponible</h4>
												<button type="button" class="close" data-dismiss="modal">
													<span>×</span>
												</button>
											</div>
											@if($movimiento->racion_disponible)
											<div class="modal-movimiento-body">
												<div id="p_body">
													<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
														<thead >
															<tr>
																<th scope="col">Ración</th>
																<th scope="col">Horario</th>
																<th scope="col">Fecha</th>
																<th scope="col">Stock</th>
																<th scope="col">Restantes</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>{{$movimiento->racion_disponible->horario_racion->racion->name}}</td>
																<td>{{$movimiento->racion_disponible->horario_racion->horario->name}}</td>
																<td>{{$movimiento->racion_disponible->fecha()}}</td>
																<td>{{$movimiento->racion_disponible->stock_original}}</td>
																<td>{{$movimiento->racion_disponible->cantidad_restante}}</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											@endif
										</div>
									</div>
								</div>

							</div>
							@endforeach
						@endif
					</div>
				</div>
				</div>
			</div>

@endsection
@section('script')
  <script type="text/javascript">
  	$(document).ready(function(){
  		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
  		document.getElementById("nav-movimientos").setAttribute("class","nav-link active");
  		});
  </script>
@endsection

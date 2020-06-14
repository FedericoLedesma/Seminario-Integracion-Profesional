@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
		div.blueTable {
		  border: 1px solid #1F78B3;
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
		  background: #CBD9F5;
		}
		.divTable.blueTable .divTableHeading {
		  background: #566CA4;
		  background: -moz-linear-gradient(top, #8091bb 0%, #677aad 66%, #566CA4 100%);
		  background: -webkit-linear-gradient(top, #8091bb 0%, #677aad 66%, #566CA4 100%);
		  background: linear-gradient(to bottom, #8091bb 0%, #677aad 66%, #566CA4 100%);
		  border-bottom: 1px solid #444444;
		}
		.divTable.blueTable .divTableHeading .divTableHead {
		  font-size: 15px;
		  font-weight: bold;
		  color: #FFFFFF;
		  border-left: 2px solid #E6F5E4;
		}
		.divTable.blueTable .divTableHeading .divTableHead:first-child {
		  border-left: none;
		}

		.blueTable .tableFootStyle {
		  font-size: 14px;
		  font-weight: bold;
		  color: #4BFFAE;
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
@section('content')

<h1>Movimientos</h1>
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
<div class="col-md-10 col-md-offset-2">
	<div class="table-responsive">
		<!--<div class="table table-striped table-hover ">  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
		<div class="divTable blueTable">
			<div class="divTableHeading">
				<div class="divTableRow">
							<div class="divTableHead">Racion</div>
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
											<div class="modal-movimiento-header" id="modal-movimiento-header">
												<button type="button" class="close" data-dismiss="modal">
													<span>×</span>
												</button>

												<h4>Racion disponible</h4>
											</div>
											@if($movimiento->racion_disponible)
											<div class="modal-movimiento-body">
												<div id="p_body">
													<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
														<thead >
															<tr>
																<th scope="col">Racion</th>
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

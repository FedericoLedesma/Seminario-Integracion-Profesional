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
<li class="breadcrumb-item active">Raciones Disponibles</li>
@endsection
@section('content')


	    <h1>Raciones Disponibles registradas</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

<form method="get" action={{ route('raciones-disponibles.create') }}>

		<button class="btn btn-primary" type="submit">Agregar Disponibilidad</button>


</form>
<div>
	<div id="alert" class="alert alert-info"></div>
	@if($query)
		<div id="alert" name="alert-raciones" class="alert alert-info">Raciones con el {{$busqueda_por}} = {{$query}}</div>
	@endif
</div>
<div class="container">
	<div class="table-responsive">
  	<div class="col-md-10 col-md-offset-2">
			<div class="panel-heading">
				 {!!Form::open(['route'=>'raciones-disponibles.index','method'=>'GET']) !!}
						<div class="input-group mb-3">
					 	<table class="table table-striped table-hover ">
							<thead>
						 		<tr>
									<th scope="col">Fecha</th>
									<th scope="col">Horarios</th>
									<th scope="col">Nombre Racion</th>
									<th scope="col"></th>
								</tr>
						 	</thead>
						 	<tbody>
							 	<tr>
								 	<td>{!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha']);!!}</td>
								 	<td>
									 	<select class="browser-default custom-select" id="busqueda_horario_por" name="busqueda_horario_por">
									 		<option value="busqueda_todos" >Todos</option>
									 	 	@if($horarios)
												@foreach($horarios as $horario)
													<option value="{{$horario->id}}" >{{$horario->name}}</option>
												@endforeach
											@endif
										</select>
									</td>
								 	<td>
								 		{!!	Form::text('racion_name',null,['id'=>'racion_name','class'=>'form-control','name'=>'search','placeholder'=>'Nombre de Racion'])!!}
								 	</td>
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

		<div class="col-md-10 col-md-offset-2">
			<div class="table-responsive">
				<!--<div class="table table-striped table-hover ">  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
				<div class="divTable blueTable">
					<div class="divTableHeading">
						<div class="divTableRow">
								<div class="divTableHead">Racion</div>
								<div class="divTableHead">Horario</div>
								<div class="divTableHead">Fecha</div>
								<div class="divTableHead">Stock</div>
								<div class="divTableHead">Restante</div>
								<div class="divTableHead">Accion</div>


							</div>
						</div>

						@if($racionesDisponibles)
							@foreach($racionesDisponibles as $racionDisponible)
						<div class="divTableBody">
							<div class="divTableRow">
									<div class="divTableCell">{{$racionDisponible->horario_racion->racion->name}}</div>
									<div class="divTableCell">{{$racionDisponible->horario_racion->horario->name}}</div>
									<div class="divTableCell">{{$racionDisponible->fecha()}}</div>
									<div class="divTableCell">{{$racionDisponible->stock_original}}</div>
									<div class="divTableCell">{{$racionDisponible->cantidad_restante}}</div>
                  @if($racionDisponible->fecha >= date("Y-m-d"))
									<div class="divTableCell"><a href="#" class="btn btn-primary pull-right btn-agregar" data-id="{{$racionDisponible}}" data-toggle="modal" data-target="#create-stock">
											Agregar
									</a>
                  @else
                    <div class="divTableCell"><a href="#" class="btn btn-primary pull-right btn-agregar disabled" data-id="{{$racionDisponible}}" data-toggle="modal" data-target="#create-stock" >
  											Agregar
  									</a>
                  @endif
                  <a href="#" class="btn btn-success pull-right btn-movimientos" data-toggle="modal" data-target="#modal-movimientos-{{$racionDisponible->id}}">
											Movimientos
									</a>
                  @if($racionDisponible->fecha >= date("Y-m-d"))
                  <button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $racionDisponible }}">Eliminar</button>
                  @else
                  <button type="submit" class="btn btn-danger eliminar disabled" data-token="{{ csrf_token() }}" data-id="{{ $racionDisponible }}">Eliminar</button>
                  @endif
								</div>
							</div>
						</div>
						<div class="modal fade" id="modal-movimientos-{{$racionDisponible->id}}">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-movimiento-header" id="modal-movimiento-header">
										<button type="button" class="close" data-dismiss="modal">
											<span>×</span>
										</button>

										<h4>Movimientos  de {{$racionDisponible->horario_racion->racion->name}} </h4>
									</div>
									@if($racionDisponible->movimientos())
									<div class="modal-movimiento-body">
										<div id="p_body">
											<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
												<thead >
													<tr>
														<th scope="col">Racion</th>
														<th scope="col">Horario</th>
														<th scope="col">Fecha</th>
														<th scope="col">Tipo de Mov.</th>
														<th scope="col">Cantidad</th>
														<th scope="col">ID Personal Responsable</th>
													</tr>
												</thead>
												<tbody>
												@foreach($racionDisponible->movimientos() as $movimiento)
													<tr>
														<td>{{$movimiento->racion_disponible->horario_racion->racion->name}}</td>
														<td>{{$movimiento->racion_disponible->horario_racion->horario->name}}</td>
														<td>{{$movimiento->racion_disponible->fecha()}}</td>
														<td>{{$movimiento->tipoMovimiento->name}}</td>
														<td>{{$movimiento->cantidad}}</td>
														<td>
															<a href="/personas/{{$movimiento->personal->id}}">{{$movimiento->personal->id}} - {{$movimiento->personal->persona->apellido}}  </a>
														</td>
													</tr>
												@endforeach
												</tbody>
											</table>
										</div>
									</div>
									@endif
								</div>
							</div>
						</div>



					@endforeach
				@endif
			</div>
		</div>
@if($racionesDisponibles)
</div>
  <div class="modal fade" id="create-stock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
							<h4>Agregar cantidad al stock</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">
							<table>
								<tr>
									<td>
											{!!	Form::label('cantidad', 'Cantidad Stock')!!}
									</td>
									<td>
										<input type="number" id="cantidad_stock" name="cantidad_stock" min="0" step="1">
									</td>
								</tr>
							</table>
            </div>
            <div class="modal-footer">
                <a href="" data-id="{{$racionDisponible}}" data-user={{Auth::user()}} class="btn btn-primary guardarStock" >Guardar</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('script')
 <script src="{{asset('js/racion-disponibles-script.js')}}"></script>
@endsection

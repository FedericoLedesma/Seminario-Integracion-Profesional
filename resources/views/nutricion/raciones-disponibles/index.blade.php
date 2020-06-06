@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.table{display:table;}
.theader{
	display:table-header-group;
	font-size:1.2em;
}
.tbody{display:table-row-group;}
.tfooter{
	display:table-footer-group;
	font-weight:bold;
	font-size:1.2em;
}
.tr{
	display:table-row;
}
.td,.th{
	display:table-cell;
	width:120px;
	height:40px;
	padding:8px;
	vertical-align: middle;
}
.td{
	text-align:center;
}

.th{
	font-weight:bold;
	text-align:right;
}

.theader .th{
	text-align:center;
}

.tr .td:nth-child(8){
	font-size:1.2em;
	border-left:1px solid #000;
	border-right:1px solid #000;
}
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
  	<div class="col-md-12 col-md-offset-2">
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

		<div class="col-md-12 col-md-offset-2">
			<div class="panel-heading">
				<div class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
					<div class="table">
						<div class="theader">
							<div class="row">
								<div class="td">Racion</div>
								<div class="td">Horario</div>
								<div class="td">Fecha</div>
								<div class="td">Stock</div>
								<div class="td">Restante</div>
								<div class="td">Accion</div>
								<div class="td">   -    </div>
								<div class="td">   -    </div>

							</div>
						</div>

						@if($racionesDisponibles)
							@foreach($racionesDisponibles as $racionDisponible)
						<div class="tbody">
							<div class="row">
									<div class="td">{{$racionDisponible->horario_racion->racion->name}}</div>
									<div class="td">{{$racionDisponible->horario_racion->horario->name}}</div>
									<div class="td">{{$racionDisponible->fecha()}}</div>
									<div class="td">{{$racionDisponible->stock_original}}</div>
									<div class="td">{{$racionDisponible->cantidad_restante}}</div>

									<div class="td"><a href="#" class="btn btn-primary pull-right btn-agregar" data-id="{{$racionDisponible}}" data-toggle="modal" data-target="#create-stock">
											Agregar
									</a></div>
									<div class="td"><a href="#" class="btn btn-success pull-right btn-movimientos" data-toggle="modal" data-target="#modal-movimientos-{{$racionDisponible->id}}">
											Movimientos
									</a></div>
									<div class="td"><button type="submit" class="btn btn-danger eliminar" data-token="{{ csrf_token() }}" data-id="{{ $racionDisponible }}">Eliminar</button></div>
							</div>
						</div>
					</div>
					@if($racionDisponible->movimientos())
						<div class="modal fade" id="modal-movimientos-{{$racionDisponible->id}}">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-movimiento-header" id="modal-movimiento-header">
										<button type="button" class="close" data-dismiss="modal">
											<span>×</span>
										</button>
										<h4>Movimientos  de {{$racionDisponible->horario_racion->racion->name}} </h4>
									</div>
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
								</div>
							</div>
						</div>
						@endif
					@endforeach
				@endif
			</div>
		</div>
	</div>
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

@endsection
@section('script')
 <script src="{{asset('js/racion-disponibles-script.js')}}"></script>
@endsection

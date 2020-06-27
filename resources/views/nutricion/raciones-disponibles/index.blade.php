@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
div.blueTable {
  width: 100%;
  text-align: center;
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
  border-bottom: 1px solid #646D75;
  border-top: 1px solid #646D75;
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
<li class="breadcrumb-item active">Raciones Disponibles</li>
@endsection
@section('titulo')
  RACIONES DISPONIBLES REGISTRADAS
@endsection
@section('content')

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
									<th scope="col">Nombre de ración</th>
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
								 		{!!	Form::text('racion_name',null,['id'=>'racion_name','class'=>'form-control','name'=>'search','placeholder'=>'Nombre de Ración'])!!}
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
</div>
<div class="col-md-auto col-md-offset-2">
	<div class="table-responsive">
		<div class="divTable blueTable">
			<div class="divTableHeading">
				<div class="divTableRow">
						<div class="divTableHead">Ración</div>
						<div class="divTableHead">Horario</div>
						<div class="divTableHead">Fecha</div>
						<div class="divTableHead">Stock</div>
						<div class="divTableHead">Restante</div>
						<div class="divTableHead">Acción</div>
				</div>
			</div>
      	<div class="divTableBody">
        @if($racionesDisponibles)
          @foreach($racionesDisponibles as $racionDisponible)
            <!--Comienzo de la fila de raciones-->
            <div class="divTableRow">
              <div class="divTableCell">{{$racionDisponible->horario_racion->racion->name}}</div>
    					<div class="divTableCell">{{$racionDisponible->horario_racion->horario->name}}</div>
    					<div class="divTableCell">{{$racionDisponible->fecha()}}</div>
    					<div class="divTableCell">{{$racionDisponible->stock_original}}</div>
    					<div class="divTableCell">{{$racionDisponible->cantidad_restante}}</div>

    					<div class="divTableCell">
                @if($racionDisponible->fecha >= date("Y-m-d"))
                <a href="#" class="btn btn-primary pull-right btn-agregar" data-id="{{$racionDisponible}}" data-toggle="modal" data-target="#create-stock">
      							Agregar
      					</a>
                @else
                <a href="#" class="btn btn-primary pull-right btn-agregar disabled" data-id="{{$racionDisponible}}" data-toggle="modal" data-target="#create-stock">
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
            <!--fin de la fila de raciones-->
            <!--comienzo del modal de movimientos-->
            <div class="modal fade" id="modal-movimientos-{{$racionDisponible->id}}">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4>Movimientos de {{$racionDisponible->horario_racion->racion->name}} </h4>
                    <button type="button" class="close" data-dismiss="modal">
                      <span>×</span>
                    </button>
                  </div>
  								@if($racionDisponible->movimientos())
  								<div class="modal-movimiento-body">
  									<div id="p_body">
  										<table class="table table-striped table-responsive ">
  											<thead >
  												<tr>
  													<th scope="col">Ración</th>
  													<th scope="col">Horario</th>
  													<th scope="col">Fecha</th>
                            <th scope="col">Fecha del mov.</th>
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
                            <td>{{$movimiento->creado}}</td>
  													<td>{{$movimiento->tipoMovimiento->name}}</td>
  													<td>{{$movimiento->cantidad}}</td>
  													<td>
  														<a href="/personas/{{$movimiento->user->personal->id}}">{{$movimiento->user->id}} - {{$movimiento->user->personal->persona->apellido}}  </a>
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
            <!--fin del modal de movimientos-->
            <!--Modal de stock-->
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
                    <p>Ración {{$racionDisponible->horario_racion->racion->name}}
                    </p>
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
            <!--Fin del modal de stock-->
          @endforeach
        @endif
      </div>
		</div>
	</div>
</div>
@endsection
@section('script')
  <script src="{{asset('js/racion-disponibles-script.js')}}"></script>
  <script type="text/javascript">
   	$(document).ready(function(){
   		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
   		document.getElementById("nav-disponibilidad").setAttribute("class","nav-link active");
   	});
  </script>
@endsection

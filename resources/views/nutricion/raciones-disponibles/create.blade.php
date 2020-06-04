@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('raciones.index') }}">Raciones</a></li>
		<li class="breadcrumb-item active">Crear Racion</li>
@endsection
@section('content')

    <h1>Agregar Racion</h1>
		<div id="alert" class="alert alert-danger"></div>
     @include('layouts.error')
     <div class="container">

     	<div class="table-responsive">
       	<div class="col-md-8 col-md-offset-2">

      <div class="panel-heading">
					{!!Form::open(['method'=>'post','action'=>'RacionesDisponiblesController@store'])!!}
     					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
     						<thead >
     							<tr>
     								<th scope="col">Fecha</th>
										<th>Horario</th>
										<th>Racion</th>
										<th>Cantidad</th>
     							</tr>
     						</thead>
     						<tbody id="tbody">
                  <tr>
                    <td>
                      	{!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha']);!!}
                    </td>
                    <td>
											<select class="custom-select" id="option-horario" name="name_horario">
												<option value="Horarios">Horarios</option>
												@if($horarios)
												@foreach($horarios as $horario)
													<option value="{{$horario->id}}">{{$horario->name}}</option>
												@endforeach
												</select>
												@endif
                    </td>
										<td>
											<select id="miSelect" class="miSelect">
											</select>
										</td>
										<td>

											<input type="number" id="cantidad" name="cantidad" min="0" step="1" value="0">
										</td>
                  </tr>
								<tr>
									<td>
										<!--<a href="#" class="btn btn-primary btn-ver pull-right" >
										    Ver raciones
										</a>-->
									</td>
									<td>
											<a href="#" class="btn btn-success guardarDisponibilidad" id="guardarDisponibilidad">
											    Guardar Disponibilidad
											</a>
									</td>
								</tr>
     						</tbody>
     					</table>
							 {!! Form::close() !!}

     			</div>
     		</div>
     	</div>
     </div>
@endsection
@section('script')
 <script src="{{asset('js/racion-disponibles-script.js')}}"></script>


@endsection

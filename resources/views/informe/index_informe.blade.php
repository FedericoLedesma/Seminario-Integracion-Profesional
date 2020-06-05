@extends('layouts.layout')
@section('content')
<div class="container">
  <div class="table-responsive">
		<div class="col-md-11 col-md-offset-1">
			<div class="panel-heading">
				{!!Form::open(['route'=>'informe.generar-informe','method'=>'GET']) !!}
				<div class="input-group mb-3">
					<table class="table table-striped table-hover ">
						<thead>
							<tr>
								<th scope="col">Fecha</th>
								<th scope="col">Tipo Persona</th>
								<th scope="col">Horarios  </th>
								<th scope="col">Nombre Sector</th>
								<th scope="col">N. habitacion</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha']);!!}</td>
								<td>
								<select class="browser-default custom-select" id="busqueda_persona_por" name="busqueda_persona_por">
									<option value="busqueda_todos" >Todos</option>
									<option value="busqueda_pacientes">Pacientes</option>
									<option value="busqueda_personal">Personal</option>
								</select>
								</td>
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
								<td>
									{!!	Form::text('sector_name',null,['id'=>'sector_name','class'=>'form-control','name'=>'search','placeholder'=>'Todos los sectores'])!!}
								</td>
								<td>
									{!!	Form::number('habitacion_id',null,['id'=>'habitacion_id','class'=>'form-control','name'=>'search_habitacion'])!!}
								</td>
								<td>
									{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
								</td>
							</tr>

							<tr>

							</tr>
							<tr>

							</tr>
						</tbody>
					</table>
				</div>
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

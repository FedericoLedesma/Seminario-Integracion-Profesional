@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="container">
  <div class="table-responsive">
		<div class="col-md-11 col-md-offset-1">
			<div class="panel-heading">
				{!!Form::open(['route'=>'informe.generar-informe-raciones','method'=>'POST']) !!}
				<div class="input-group mb-3">
					<table class="table table-striped table-hover ">
						<thead>
							<tr>
								<th scope="col">Fecha</th>
								<th scope="col">Horarios  </th>
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
								<td>
									{!!	Form::submit('Generar Informe de Raciones',['class'=>'btn btn-primary'])!!}
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
@section('script')
 <script src="{{asset('js/script.js')}}"></script>
@endsection

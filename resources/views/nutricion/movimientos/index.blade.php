@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
<li class="breadcrumb-item active">Movimientos</li>
@endsection
@section('content')


	    <h1>Movimientos</h1>
	      @include('layouts.error')

<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>

<div>

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

									<th scope="col"></th>

								</tr>

						 </thead>
						 <tbody>
							 <tr>
								 <td>{!!Form::date('fecha', \Carbon\Carbon::now(),['id'=>'fecha']);!!}</td>

								 <td>
									 {!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
								 </td>
							 </tr>

						 </tbody>
					 </table>
					 </div>
					{!! Form::close() !!}

					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
						<thead >
							<tr>
								<th scope="col">Racion</th>
								<th scope="col">Horario</th>
								<th scope="col">Fecha</th>
								<th scope="col">Tipo de Mov.</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Accion</th>

							</tr>
						</thead>

						<tbody>
						@if($movimientos)
							@foreach($movimientos as $movimiento)
							<tr>
								<td>{{$movimiento->racion_disponible->horario_racion->racion->name}}</td>
								<td>{{$movimiento->racion_disponible->horario_racion->horario->name}}</td>
								<td>{{$movimiento->racion_disponible->fecha()}}</td>
								<td>{{$movimiento->tipoMovimiento->name}}</td>
								<td>{{$movimiento->cantidad}}</td>
								<td>
									{!!Form::button('ver',['class'=>'btn btn-primary','type'=>'submit'])!!}

								</td>

							</tr>
								@endforeach
							@endif

					</table>
			</div>
		</div>
	</div>
</div>


@endsection
@section('script')

@endsection

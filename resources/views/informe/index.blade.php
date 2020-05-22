<head>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>

@extends('layouts.layout')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
@endsection
@section('content')

<!-- INDEX DEL ROL -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->

	  	<title>Informes</title>



<!-- UTILIZAR PLANTILLA BLADE PARA PERSONALIZAR LAS TABLAS SE REPITE CON ROLES -->

		<style>
<!--
.table{
	 background-color: #E3EEE9;


}
-->
</style>
<form method="get" action={{ route('menu_persona.index') }}>

		<button class="btn btn-primary" type="submit">Volver a planillas</button>


</form>
<div>
	<p>
		<span id="menu_persona-total">
			<!-- Aca deben ir el total de roles -->

		</span>
	</p>

</div>

<div class="container">
    <!--  <div class="row">-->
    <div class="table-responsive">
         <div class="col-md-8 col-md-offset-2">
             <!--<div class="panel panel-default">-->
				 <div class="panel-heading">
				 {!!Form::open(['route'=>'InformeController.create','method'=>'GET']) !!}
					 <div class="input-group mb-3">

					 <input class="date form-control" type="text" id="fecha_inicio" name="fecha_inicio" value={{$fecha_actual}}>
					 <script type="text/javascript" id="calendario_" name="calendario_">
					 	 var new_date = $('.date').datepicker({format: 'yyyy-mm-dd'});
					 </script>

					 <select class="browser-default custom-select" id="horario_inicio" name="horario_inicio">
						 @foreach($horarios as $horario)
						 <option value={{$horario->id}} > {{$horario->name}}</option>
						 @endforeach
					 </select>

					 <input class="date form-control" type="text" id="fecha_fin" name="fecha_fin"  value={{$fecha_actual}}>
					 <script type="text/javascript" id="calendario_" name="calendario_">
					 	 var new_date = $('.date').datepicker({format: 'yyyy-mm-dd'});
					 </script>

 					 <select class="browser-default custom-select" id="horario_fin" name="horario_fin">
 						 @foreach($horarios as $horario)
 						 <option value={{$horario->id}} > {{$horario->name}}</option>
 						 @endforeach
 					 </select>

					 </div>

					{!!	Form::submit('Generar un informe entre las fechas',['class'=>'btn btn-success btn-buscar'])!!}
					{!! Form::close() !!}


				</div>

				</div>
			  </div>
				 </div>
				<!--</div>-->
@endsection
@section('script')
 <script src="{{asset('js/role-script.js')}}"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
 <script type="text/javascript" src="dist/js/multiselect.min.js"></script>



 <script type="text/javascript">
 $(document).ready(function() {
     // make code pretty
     window.prettyPrint && prettyPrint();

     $('.multiselect').multiselect();
 });
 </script>
@endsection

@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('raciones.index') }}">Raciones</a></li>
		<li class="breadcrumb-item active">Ver Racion</li>
@endsection
@section('titulo')
  Ver ración
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($racion)
	    <div class="table-responsive">
	    <h4>Ración:  {{$racion->name}}</h4>
        <div class="col-md-8 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$racion->id}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$racion->name}}</td>
			</tr>
      <tr>
				<td>Observación </td>
				<td>{{$racion->observacion}}</td>
			</tr>
      <tr>
				<td>Alimentos </td>
				<td>
          @foreach($racion->alimentos as $alimento)
            {{$alimento->name}}, cantidad: {{$alimento->pivot->cantidad}} @if($racion->racion_alimento($alimento->id)->unidad){{$racion->racion_alimento($alimento->id)->unidad->name}}@endif</br>
          @endforeach
        </td>
			</tr>
			<tr>
				<td>Creado </td>
				<td>{{date("d/m/Y H:i:s", strtotime($racion->created_at))}}</td>
			</tr>
			<tr>
				<td>Modificado </td>
				<td>{{date("d/m/Y H:i:s", strtotime($racion->updated_at))}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('raciones.edit', $title = 'Modificar', $parameters = [$racion],['class' => 'btn btn-warning'], $attributes = [])!!}





@endif
@endsection
@section('script')
  <script type="text/javascript">
  	$(document).ready(function(){
  		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
  		document.getElementById("nav-raciones").setAttribute("class","nav-link active");
  		});
  </script>
@endsection

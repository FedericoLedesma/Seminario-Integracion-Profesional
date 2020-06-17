@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personas.index') }}">Persona</a></li>
		<li class="breadcrumb-item active">Ver Persona</li>
@endsection
@section('titulo')
  Ver persona
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($persona)
	    <div class="table-responsive">
	    <h3>Persona: {{$persona->apellido}} {{$persona->name}}</h3>
        <div class="col-md-8 col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$persona->id}}</td>
			</tr>
      <tr>
				<td>Tipo Doc </td>
				<td>{{$persona->tipoDocumento->name}}</td>
			</tr>
      <tr>
				<td>Número de doc. </td>
				<td>{{$persona->numero_doc}}</td>
			</tr>
      <tr>
				<td>Tipo de doc. </td>
				<td>{{$persona->tipoDocumento->name}}</td>
			</tr>
			<tr>
				<td>Apellido </td>
				<td>{{$persona->apellido}}</td>
			</tr>
      <tr>
				<td>Nombre </td>
				<td>{{$persona->name}}</td>
			</tr>
      <tr>
				<td>Observación </td>
				<td>{{$persona->observacion}}</td>
			</tr>
      <tr>
				<td>EMail </td>
				<td>{{$persona->email}}</td>
			</tr>
      <tr>
				<td>Provincia </td>
				<td>{{$persona->provincia}}</td>
			</tr>
      <tr>
				<td>Localidad </td>
				<td>{{$persona->localidad}}</td>
			</tr>
      <tr>
				<td>Sexo </td>
				<td>{{$persona->sexo}}</td>
			</tr>
      <tr>
				<td>Patologías </td>
				<td>
          @if(count($persona->patologias)>0)
          @foreach($persona->patologias as $patologia)
            {{$patologia->name }}</br>
          @endforeach
          @else
          {{"No tiene patologías"}}
          @endif
        </td>
			</tr>
      <tr>
				<td>Fecha de Nacimiento </td>
				<td>{{date("d/m/Y", strtotime($persona->fecha_nac))}}</td>
			</tr>
			<tr>
				<td>Creado </td>
				<td>@if($persona->created_at){{date("d/m/Y H:i:s", strtotime($persona->created_at))}}@endif</td>
			</tr>
			<tr>
				<td>Modificado </td>
				<td>@if($persona->updated_at){{date("d/m/Y H:i:s", strtotime($persona->updated_at))}}@endif</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('personas.edit', $title = 'Modificar', $parameters = [$persona],['class' => 'btn btn-warning'], $attributes = [])!!}
  {!!link_to_route('personas.historial', $title = 'Historial', $parameters = [$persona],['class' => 'btn btn-info'], $attributes = [])!!}




@endif
@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
   document.getElementById("nav-personas").setAttribute("class", "nav-link active");
   });
</script>
@endsection

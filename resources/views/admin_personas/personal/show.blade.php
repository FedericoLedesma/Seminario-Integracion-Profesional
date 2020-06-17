@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personal.index') }}">Personal</a></li>
		<li class="breadcrumb-item active">Ver personal</li>
@endsection
@section('titulo')
Ver personal
@endsection
@section('content')

	   @include('layouts.error')
	  	@if($personal)




	    <div class="table-responsive">
	    <h4>Datos de {{$personal->get_apellido()}} {{$personal->get_name()}}</h4>
        <div class="col-md-auto col-md-offset-1">
         <div class="panel-heading">
	    <table class="table table-bordered table-hover table-striped">
	    	<tr>
	    		<td>ID </td>
				<td>{{$personal->get_id()}}</td>
			</tr>
			<tr>
				<td>Nombre </td>
				<td>{{$personal->get_name()}}</td>
			</tr>
			<tr>
				<td>Apellido </td>
				<td>{{$personal->get_apellido()}}</td>
			</tr>
      <tr>
				<td>Tipo Doc </td>
				<td>{{$personal->persona->tipoDocumento->name}}</td>
			</tr>
      <tr>
				<td>Número de doc. </td>
				<td>{{$personal->persona->numero_doc}}</td>
			</tr>
      <tr>
				<td>Tipo de doc. </td>
				<td>{{$personal->persona->tipoDocumento->name}}</td>
			</tr>
      <tr>
				<td>EMail </td>
				<td>{{$personal->persona->email}}</td>
			</tr>
      <tr>
				<td>Provincia </td>
				<td>{{$personal->persona->provincia}}</td>
			</tr>
      <tr>
				<td>Localidad </td>
				<td>{{$personal->persona->localidad}}</td>
			</tr>
      <tr>
				<td>Sexo </td>
				<td>{{$personal->persona->sexo}}</td>
			</tr>
      <tr>
				<td>Patologías </td>
				<td>
          @if(count($personal->persona->patologias)>0)
          @foreach($personal->persona->patologias as $patologia)
            {{$patologia->name }}</br>
          @endforeach
          @else
          {{"No tiene patologías"}}
          @endif
        </td>
			</tr>
      <tr>
				<td>Fecha de Nacimiento </td>
				<td>{{date("d/m/Y", strtotime($personal->persona->fecha_nac))}}</td>
			</tr>
			<tr>
				<td>Sector </td>
				<td>{{$personal->get_sector_name()}}</td>
			</tr>
			<tr>
				<td>CREADO </td>
				<td>{{date("d/m/Y H:i:s", strtotime($personal->created_at))}}</td>
			</tr>
			<tr>
				<td>MODIFICADO </td>
				<td>{{date("d/m/Y H:i:s", strtotime($personal->updated_at))}}</td>
			</tr>

		</table>
		</div>
		</div>
		</div>
	{!!link_to_route('personal.edit', $title = 'Cambiar de sector', $parameters = [$personal],['class' => 'btn btn-warning'], $attributes = [])!!}
  {!!link_to_route('personas.edit', $title = 'Modificar datos personales', $parameters = [$personal->get_persona()],['class' => 'btn btn-warning'], $attributes = [])!!}
  {!!link_to_route('personal.showProfesiones', $title = 'Especialidades', $parameters = [$personal->get_persona()],['class' => 'btn btn-warning'], $attributes = [])!!}
@endif
@endsection

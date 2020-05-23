@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('patologias.index') }}">Patologias</a></li>
		<li class="breadcrumb-item active">Editar Patologia</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($patologia, ['route' => ['patologias.update', $patologia->id], 'method'=> 'PUT'])!!}
	 	@if($patologia)
	    <h1>Editar Patologia  {{$patologia->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
          <div class="alert alert-info" role="alert">
              Presione 'Guardar' para generar una nueva Dieta Activa
          </div>
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$patologia->id}}</td>
  			</tr>
        <tr>
  				<td>Tipo Patologia </td>
  				<td>
          @if($tipos_patologias)
            <select name="tipo_patologia_id">
              @foreach ($tipos_patologias as $tipo_patologia)

              <!-- Opciones de la lista -->
                @if($tipo_patologia->id==$patologia->tipo_patologia_id)
                <option value="{{$tipo_patologia->id}}" selected >{{$tipo_patologia->name}}</option>
                @else
                <option value="{{$tipo_patologia->id}}" >{{$tipo_patologia->name}}</option>  <!-- Opci�n por defecto -->
                @endif
              @endforeach
            </select>
          @endIf
        </td>

        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$patologia->name)!!}</td>
  			</tr>
        <tr>
          <td>Descripcion </td>
          <td>{!!	Form::text('descripcion',$patologia->descripcion)!!}</td>
        </tr>
		   	<tr>

		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		    </td>
        </tr>
        <tr>

		   	</tr>
		 </table>
		 @endif
     <h6>Alimentos Prohibidos</h6>
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <td>Nombre</td>
            <td>Quitar</td>
          </tr>
        </thead>
        <tbody>
       @foreach($patologia->alimentos as $alimento)
          <tr>
            <tr>
               <td>
                   {{$alimento->name}}
               </td>
              <td><button type="submit" class="btn btn-danger quitarAlimento" data-token="{{ csrf_token() }}" data-id="{{ $alimento }}" data-racion="{{ $patologia }}">X</button></td>
            </tr>
          </tr>
      @endforeach
        <tr>
          <td>{!!link_to_route('patologia.agregarAlimentosProhibidos', $title = 'Agregar Alimentos', $parameters = [$patologia->id], $attributes = ['class'=>'btn btn-secondary'])!!}</td>
  	    	<td>
  		   	{!!link_to_route('patologias.show', $title = 'CANCELAR', $parameters = [$patologia], $attributes = [])!!}
  		   	</td>
        </tr>
        </tbody>
    </table>
		</div>
		</div>
@endsection

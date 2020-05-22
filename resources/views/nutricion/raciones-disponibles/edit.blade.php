@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('raciones.index') }}">Raciones</a></li>
		<li class="breadcrumb-item active">Editar Racion</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($racion, ['route' => ['raciones.update', $racion->id], 'method'=> 'PUT'])!!}
	 	@if($racion)
	    <h1>Editar Racion  {{$racion->name}}</h1>
      <div id="alert" class="alert alert-info"></div>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-6 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    	<td>ID </td>
				<td>{{$racion->id}}</td>

        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$racion->name)!!}</td>
  			</tr>
		 </table>
		 @endif
     <h6>Editar / quitar  Alimentos</h6>
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <td>Nombre</td>
            <td>Cantidad</td>
            <td>Quitar</td>
          </tr>
        </thead>
        <tbody>
       @foreach($racion->alimentos as $alimento)
          <tr>
            <tr>
               <td>
                   {{$alimento->name}}
               </td>
               <td>
                 {!!Form::text('cantidad-'.$alimento->id,$racion->getAlimento($alimento->id)->first()->pivot->cantidad)!!}
               </td>
               	<td><button type="submit" class="btn btn-danger quitarAlimento" data-token="{{ csrf_token() }}" data-id="{{ $alimento }}" data-racion="{{ $racion }}">X</button></td>
            </tr>
          </tr>

      @endforeach
        </tbody>
    </table>
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <td>  {!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}</td>
        <td>{!!link_to_route('racion.agregarAlimentos', $title = 'Agregar Alimentos', $parameters = [$racion->id], $attributes = ['class'=>'btn btn-secondary'])!!}</td>
        <td>{!!link_to_route('raciones.show', $title = 'CANCELAR', $parameters = [$racion], $attributes = ['class'=>'btn btn-warning'])!!}</td>
      </tr>
    </table>



		</div>
		</div>
    <div class="col-md-6 col-md-offset-6">

  </div>
@endsection
@section('script')
 <script src="{{asset('js/racion-script.js')}}"></script>

@endsection

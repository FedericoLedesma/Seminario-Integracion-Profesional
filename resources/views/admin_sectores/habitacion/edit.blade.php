@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('habitaciones.index') }}">Habitaciones</a></li>
		<li class="breadcrumb-item active">Editar habitación</li>
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($habitacion, ['route' => ['habitaciones.update', $habitacion->id], 'method'=> 'PUT'])!!}
	 	@if($habitacion)
	    <h1>Editar habitación:  {{$habitacion->name}}</h1>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-3 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$habitacion->id}}</td>
  			</tr>
        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$habitacion->name)!!}</td>
  			</tr>
        <tr>
  				<td>Cantidad de camas </td>
  				<td>{!!	Form::text('cantidad_camas',$habitacion->get_cantidad_camas())!!}</td>
  			</tr>
        <tr>
  				<td>Descripcion </td>
  				<td>{!!	Form::text('descripcion',$habitacion->descripcion)!!}</td>
  			</tr>
        <tr>
  				<td>Sector </td>
  				<td>
            <select class="browser-default custom-select" id='sector_id' name='sector_id'>
               @foreach($sectores as $sector)
                   <option value= {{$sector->get_id()}}> {{$sector->get_name()}}</option>
               @endforeach
            </select>
          </td>
  			</tr>
		   	<tr>
  		     <td>{!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
  		    </td>
        </tr>
        <tr>
		    <td>
		   	{!!link_to_route('habitaciones.show', $title = 'CANCELAR', $parameters = [$habitacion->id], $attributes = [])!!}
		   	</td>
		   	</tr>
		 </table>
		 @endif

		</div>
		</div>
@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
    document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
    document.getElementById("nav-administracion-habitaciones").setAttribute("class", "nav-link active");
   });
</script>
@endsection

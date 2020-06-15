@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personas.index') }}">Personas</a></li>
		<li class="breadcrumb-item active">Editar Persona</li>
@endsection
@section('titulo')
Editar Persona
@endsection
@section('content')

<!-- EDIT DEL ROLE -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	 	 {!! Form::model($persona, ['route' => ['personas.update', $persona->id], 'method'=> 'PUT'])!!}
	 	@if($persona)
	    <h3>Persona  {{$persona->name}}</h3>
	      @include('layouts.error')
	    <div class="table-responsive">
        <div class="col-md-6 col-md-offset-1">
	    <table class="table table-bordered table-hover table-striped">
        <tr>
	    		<td>ID </td>
				<td>{{$persona->id}}</td>
  			</tr>
        <tr>
  				<td>Tipo Doc </td>
  				<td>
          @if($tipos_documentos)
            <select name="tipo_documento_id">
              @foreach ($tipos_documentos as $tipo_documento)

              <!-- Opciones de la lista -->
                @if($tipo_documento->id==$persona->tipo_documento_id)
                <option value="{{$tipo_documento->id}}" selected >{{$tipo_documento->name}}</option>
                @else
                <option value="{{$tipo_documento->id}}" >{{$tipo_documento->name}}</option>  <!-- Opci�n por defecto -->
                @endif
              @endforeach
            </select>
          @endIf
        </td>


  			</tr>
        <tr>
  				<td>Numero_doc </td>
  				<td>	{!!	Form::text('numero_doc',$persona->numero_doc)!!}</td>
  			</tr>
  			<tr>
  				<td>Apellido </td>
  				<td>{!!	Form::text('apellido',$persona->apellido)!!}</td>
  			</tr>
        <tr>
  				<td>Nombre </td>
  				<td>{!!	Form::text('name',$persona->name)!!}</td>
  			</tr>
        <tr>
  				<td>Observacion </td>
  				<td>{!!	Form::text('observacion',$persona->observacion)!!}</td>
  			</tr>
        <tr>
  				<td>Direccion </td>
  				<td>{!!	Form::text('direccion',$persona->direccion)!!}</td>
  			</tr>
        <tr>
  				<td>EMail </td>
  				<td>{!!	Form::text('email',$persona->email)!!}</td>
  			</tr>
        <tr>
  				<td>Provincia </td>
  				<td>{!!	Form::text('provincia',$persona->provincia)!!}</td>
  			</tr>
        <tr>
  				<td>Localidad </td>
  				<td>{!!	Form::text('localidad',$persona->localidad)!!}</td>
  			</tr>
        <tr>
  				<td>Sexo </td>
  				<td>{!!	Form::text('sexo',$persona->sexo)!!}</td>
  			</tr>
        <tr>
  				<td>Fecha de Nacimiento </td>
  				<td>{!!	Form::text('fecha_nac',$persona->fecha_nac)!!}</td>
  			</tr>
		 </table>
		 @endif

      <table class="table table-bordered table-hover table-striped">
       <tr>
          <td>
            Quitar Patologias que tiene {{$persona->name}}
          </td>
       </tr>
       @foreach($persona->patologias as $patologia)
          <tr>
            <tr>
               <td>
               <div class="form-check">
               <input class="form-check-input" type="checkbox" name="quitarPatologias[]" value="{{$patologia->id}}" id="defaultCheck{{$patologia->id}}">
                 <label class="form-check-label" for="defaultCheck{{$patologia->id}}">
                   {{$patologia->name}}
                 </label>
               </td>
            </tr>
          </tr>
      @endforeach
    </table>


    @if($patologias)
     <table class="table table-bordered table-hover table-striped">
      <tr>
         <td>
         Asociar Patologias
         </td>
      </tr>
          @foreach($patologias as $patologia)
      <tr>
         <td>
         <div class="form-check">
         <input class="form-check-input" type="checkbox" name="agregarPatologias[]" value="{{$patologia->id}}" id="defaultCheck{{$patologia->id}}">
           <label class="form-check-label" for="defaultCheck{{$patologia->id}}">
             {{$patologia->name}}
           </label>
         </td>
      </tr>
       @endforeach
     </table>
    @endif


    {!!Form::submit('Guardar',['class'=>'btn btn-success'])!!}
		</div>
		</div>
    <div class="col-md-6 col-md-offset-6">
    {!!link_to_route('personas.show', $title = 'CANCELAR', $parameters = [$persona], $attributes = ['class'=>'btn btn-warning'])!!}
  </div>
@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
   document.getElementById("nav-personas").setAttribute("class", "nav-link active");
   });
</script>
@endsection

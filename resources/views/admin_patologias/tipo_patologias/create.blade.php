@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('tipospatologias.index') }}">Tipos de Patologías</a></li>
		<li class="breadcrumb-item active">Crear Tipo Patologia</li>
@endsection
@section('titulo')
  Agregar Tipo de Patología
@endsection
@section('content')

    {!!Form::open(['method'=>'post','action'=>'TipoPatologiaController@store'])!!}

     @include('layouts.error')
     <table>
       <tr>
         <td>
             {!!	Form::label('name', 'Nombre')!!}
         </td>
         <td>
             {!!	Form::text('name')!!}
         </td>
       </tr>
       <tr>
         <td>
             {!!	Form::label('observacion', 'Observación')!!}
         </td>
         <td>
             {!!	Form::text('observacion')!!}
         </td>
       </tr>
       <tr>
         <td>
             {!!	Form::submit('Guardar',['class' => 'btn btn-success'])!!}
         </td>
         <td>
             {!!	Form::reset('Borrar',['class' => 'btn btn-secondary'])!!}
         </td>
       </tr>
    </table>
		{!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
   document.getElementById("nav-tipospatologias").setAttribute("class", "nav-link active");
   document.getElementById("nav-patologias").setAttribute("class", "nav-link active");
   });
</script>
@endsection

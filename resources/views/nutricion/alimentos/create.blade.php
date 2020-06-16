@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('alimentos.index') }}">Alimentos</a></li>
		<li class="breadcrumb-item active">Crear Alimento</li>
@endsection
@section('titulo')
 Agregar alimento
@endsection
@section('content')

    {!!Form::open(['method'=>'post','action'=>'AlimentoController@store'])!!}
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
             {!!	Form::submit('Guardar Alimento',['class' => 'btn btn-success'])!!}
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
  		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
  		document.getElementById("nav-alimentos").setAttribute("class","nav-link active");
  		});
  </script>
@endsection

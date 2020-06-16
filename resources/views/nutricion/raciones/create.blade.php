@extends('layouts.layout')
@section('token')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('raciones.index') }}">Raciones</a></li>
		<li class="breadcrumb-item active">Crear Ración</li>
@endsection
@section('titulo')
	Agregar ración
@endsection
@section('content')

    {!!Form::open(['method'=>'post','action'=>'RacionController@store'])!!}
     @include('layouts.error')
     <div class="container">

     	<div class="table-responsive">
       	<div class="col-md-8 col-md-offset-2">

      <div class="panel-heading">
     					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
     						<thead >
     							<tr>
     								<th scope="col">Nombre</th>
										<th>Observación</th>
     							</tr>
     						</thead>

     						<tbody>
                  <tr>
                    <td>
                      {!!	Form::text('name')!!}
                    </td>
                    <td>
											{!!	Form::text('observacion')!!}
                    </td>
                  </tr>
     						</tbody>


     					</table>
							{!!	Form::submit('Guardar',['class'=>'btn btn-success btn-guardar'])!!}
            {!! Form::close() !!}

     			</div>
     		</div>
     	</div>
     </div>
@endsection
@section('script')
	<script src="{{asset('js/racion-script.js')}}"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		document.getElementById("nav-nutricion").setAttribute("class","nav-link active");
  		document.getElementById("nav-raciones").setAttribute("class","nav-link active");
  		});
  </script>

@endsection

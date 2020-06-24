<head>
  <script
          src="https://code.jquery.com/jquery-3.5.1.js"
          integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
          crossorigin="anonymous">
  </script>
</head>


@extends('layouts.layout')
@section('navegacion')
    <li class="breadcrumb-item"><a href="{{route('personal.index') }}">Personal</a></li>
		<li class="breadcrumb-item active">Ingresar nuevo personal</li>
@endsection
<style>
.center {
  margin: auto;
  width: 60%;
  padding: 10px;
}
</style>
@section('titulo')
Agregar nuevo personal
@endsection
@section('content')
        @include('layouts.error')

	    {!!Form::open(['method'=>'post','action'=>'PersonalController@store'])!!}

	    <div>
        <div>
          <a href="{{action('PersonalController@createPersonal')}}" class="btn btn-primary">Ingresar a personal nuevo</a>
        </div>
        <p></p>
        <div class="container">
            <!--  <div class="row">-->
            <div class="table-responsive">
                 <div class="col-md-8 col-md-offset-2">
                     <!--<div class="panel panel-default">-->
        				 <div class="panel-heading">
        				 {!!Form::open(['route'=>'personal.index','method'=>'GET']) !!}
        					 <div class="input-group mb-3">

        					 <select class="browser-default custom-select" id="busqueda_por" name="busqueda_por">
        						 <option value="busqueda_nombre_persona" >Nombre y/o apellido</option>
        						 <option value="busqueda_dni" > Número DNI </option>
        						 <option value="busqueda_nombre_sector" > Sector </option>
        					 </select>

        						 {!!	Form::text('roleid',null,['id'=>'roleid','class'=>'form-control','name'=>'search','placeholder'=>'Ingrese el texto'])!!}
        						 <div class="input-group-append">
        							{!!	Form::submit('Buscar',['class'=>'btn btn-success btn-buscar'])!!}
        						 </div>
        					 </div>
        					{!! Form::close() !!}
                </div>
              </div>
            </div>
        </div>
        <div class="container">
            <div class="table-responsive">
                 <div class="col-md-auto col-md-offset-2">
                 <div class="panel-heading">
        					{!!	Form::label('titulo_tabla', 'Personas registradas en el sistema')!!}
        					<table class="table table-striped table-hover "><!--  align="center" border="2" cellpadding="2" cellspacing="2" style="width: 900px;">-->
        						<thead >
        							<tr>
        								<th scope="col">ID</th>
        								<th scope="col">Nombre</th>
        								<th scope="col">Tipo de doc.</th>
        								<th scope="col">Numero de doc.</th>
        								<th scope="col">Sector</th>
        								<th scope="col">Ingresar</th>

        							</tr>
        						</thead>

        						<tbody>
        						@if($personas_no_internadas)
        							@foreach($personas_no_internadas as $persona)
                      {!!Form::open(['route'=>'personal.storeExistente','method'=>'GET']) !!}
                      @include('layouts.error')
                      <tr>
        								<td>
                          <input id="persona_id" name="persona_id" value="{{$persona->get_id()}}" size=3 readonly/>
                        </td>
        								<td>{{$persona->get_name()}} {{$persona->get_apellido()}}</td>
        								<td>{{$persona->get_tipo_documento_name()}}</td>
        								<td>{{$persona->get_numero_doc()}}</td>
                        <td>
                          <select class="browser-default custom-select" id="sectores" name="sectores">
                            @if($sectores)
                              @foreach($sectores as $sector)
                                <option value= {{$sector->get_id()}}>{{$sector->get_name()}}</option>
                              @endforeach
                            @endif
                          <select/>
                        </td>
        								<td>

          								{!!	Form::submit('Ingresar',['class' => 'btn btn-success'])!!}

                        </td>

        							</tr>
                      {!! Form::close() !!}
    								@endforeach
    							@endif

        					</table>
        				</div>
        				</div>
        			  </div>
        	</div>
        </div>
		 </div>
		{!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
    document.getElementById("nav-administracion").setAttribute("class", "nav-link active");
    document.getElementById("nav-administracion-personal").setAttribute("class", "nav-link active");
   });
</script>
@endsection

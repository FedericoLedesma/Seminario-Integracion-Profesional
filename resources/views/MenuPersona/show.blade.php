@extends('layouts.layout')
@section('content')

<!-- Esto lo cree como alternativa de create.blade.php pero este hereda de layouts -->
<!-- validar los campos y establecer el campo contrase�a -->
<!-- mostrar una tabla con los roles que existen -->
	   @include('layouts.error')
	  	@if($mp)
	  	
	  	
	    <table>
	    	<tr>
	    		<td>ID Persona </td>
				<td>{{$mp->get_persona()->name}}</td>
			</tr>
			<tr>
				<td>ID Horario</td>
				<td>{{$mp->get_horario()->name}}</td>
			</tr>
			<tr>
				<td>Fecha </td>
				<td>{{$mp->fecha}}</td>
			<tr>
            <tr>
				<td>Racion </td>
				<td>{{$mp->get_racion_name()}}</td>
			<tr>
            <tr>
				<td>Personal </td>
				<td>{{$mp->personal_id}}</td>
			<tr>				
			
		</table>
	
@endif
@endsection
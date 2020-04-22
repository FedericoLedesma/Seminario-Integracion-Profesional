@extends('layouts.plantilla')
@section('content')


	

<<table>
  <tr>
    <th>Column 1 Heading</th>
    <th>Column 2 Heading</th>
  </tr>
  <tr>
    <td>Row 1: Col 1</td>
    <td>Row 1: Col 2</td>
  </tr>
</table>


				@if($permisos)
							@foreach($permisos as $permission)
							<tr>
								<td>{{$permission->id}}</td>
								<td>{{$permission->name}}</td>
								<td>{{$permission->guar_name}}</td>
								<td>{{$permission->created_at}}</td>
								<td>{{$permission->updated_at}}</td>
								
								<td>{!!	Form::submit('Borrar')!!}</td>
							</tr>
								@endforeach
							@endif
						
			
					
				
				</body>
@endsection

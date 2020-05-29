
<select class="browser-default custom-select" id="persona" name="persona">
<option value=0 > - </option>
@foreach($crud as $c)
  <option value={{$c->get_id()}} >{{$c->get_name()}}</option>
@endforeach
</select>

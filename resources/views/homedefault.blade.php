@extends('layouts.layoutdefault')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tablero</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    Esta conectado 
                    <label>{{Auth::user()->name}}</label>
                </div>
             
            </div>
        </div>
    </div>
</div>
@endsection
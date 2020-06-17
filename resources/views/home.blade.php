@extends('layouts.layout')
@section('titulo')
BIENVENIDO AL SISTEMA DE NUTRICIÓN DEL HOSPITAL SOMMER
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-auto col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Esta conectado
                    <label>{{Auth::user()->personal->persona->apellido}} {{Auth::user()->personal->persona->name}}</label>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

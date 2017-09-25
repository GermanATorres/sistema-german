@extends('layouts.app')

@section('migasdepan')
<h1>
        Usuarios
        <small>Ver contrato <b>{{ $contrato->nombree }}</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratos') }}"><i class="fa fa-dashboard"></i>Contratos</a></li>
        <li class="active">Ver</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos de Contrato</div>
                <div class="panel-body">
                        <div class="form-group{{ $errors->has('nombree') ? ' has-error' : '' }}">
                            <label for="nombree" class="col-md-4 control-label">Nombre de la Empresa o Representante: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->nombree}}</label><br>
                            
                        </div>

                         <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Dirección: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->direccion}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('telefonoe') ? ' has-error' : '' }}">
                            <label for="telefonoe" class="col-md-4 control-label">Telefono de la Empresa o Representante: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->telefonoe}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('emaile') ? ' has-error' : '' }}">
                            <label for="emaile" class="col-md-4 control-label">E-Mail Empresa: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->emaile}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('nombrer') ? ' has-error' : '' }}">
                            <label for="nombrer" class="col-md-4 control-label">Nombre de Represetante: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->nombrer}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('telfijor') ? ' has-error' : '' }}">
                            <label for="telfijor" class="col-md-4 control-label">Telefono fijo Representante (si lo hay): </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->teldijor}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('celr') ? ' has-error' : '' }}">
                            <label for="celr" class="col-md-4 control-label">Celular Representante: </label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->celr}}</label><br>
                           
                        </div>

                        <div class="form-group{{ $errors->has('emailr') ? ' has-error' : '' }}">
                            <label for="emailr" class="col-md-4 control-label">Dirección email del Representante:</label>
                            <label for="nombree" class="col-md-4 control-label">{{$contrato->emailr}}</label><br>
                            
                        </div>

                        <a href="{{ url('/contratos/'.$contrato->id.'/edit') }}" class="btn btn-warning">Editar</a> |
                      {{ Form::open(['route' => ['contratos.destroy', $contrato->id ], 'method' => 'DELETE', 'class' => 'form-horizontal'])}}
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                      {{ Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

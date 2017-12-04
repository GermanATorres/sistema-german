@extends('layouts.app')

@section('migasdepan')
<h1>
Ver detalle del plan anual
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('/paacs') }}"><i class="fa fa-dashboard"></i> Plan anual</a></li>
        <li class="active">Detalle del plan</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos del plan anual de compras </div>
                <div class="panel-body">
                  <a href="{{ url('/paacs/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar elementos</a>

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Unidad administrativa: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$paac->anio}}</label><br>
                        </div>

                         <div class="form-group{{ $errors->has('monto') ? ' has-error' : '' }}">
                            <label for="monto" class="col-md-4 control-label">Linea de trabajo: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$paac->descripcion}}</label><br>
                        </div>

                        <div class="form-group{{ $errors->has('fuente_financiamiento') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Fuente de financiamiento: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$paac->total}}</label><br>
                        </div>



                        <div style="overflow-x:auto;">
                          <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                              <th>Obra, bien o servicio</th>
                              <th>enero</th>
                              <th>febrero</th>
                              <th>marzo</th>
                              <th>abril</th>
                              <th>mayo</th>
                              <th>junio</th>
                              <th>julio</th>
                              <th>agosto</th>
                              <th>septiembre</th>
                              <th>octubre</th>
                              <th>noviembre</th>
                              <th>diciembre</th>
                              <th>total</th>
                              <th>Acción</th>
                            </thead>
                            <tbody>
                              @foreach($detalles as $detalle)
                              <tr>
                                <td>{{$detalle->obra}}</td>
                                <td>$ {{$detalle->enero}}</td>
                                <td>$ {{$detalle->febrero}}</td>
                                <td>$ {{$detalle->marzo}}</td>
                                <td>$ {{$detalle->abril}}</td>
                                <td>$ {{$detalle->mayo}}</td>
                                <td>$ {{$detalle->junio}}</td>
                                <td>$ {{$detalle->julio}}</td>
                                <td>$ {{$detalle->agosto}}</td>
                                <td>$ {{$detalle->septiembre}}</td>
                                <td>$ {{$detalle->octubre}}</td>
                                <td>$ {{$detalle->noviembre}}</td>
                                <td>$ {{$detalle->diciembre}}</td>
                                <td>$ {{$detalle->subtotal}}</td>
                                <td>
                                  {{ Form::open(['route' => ['paacdetalles.destroy', $detalle->id ], 'method' => 'DELETE', 'class' => 'form-horizontal'])}}
                                  <a href="{{url('paacdetalles/'.$detalle->id.'/edit')}}" class="btn btn-warning"><span class="glyphicon glyphicon-text-size"</span></a>
                                  <button class="btn btn-danger" type="button" onclick="
                                  return swal({
                                    title: 'Eliminar obra',
                                    text: '¿Está seguro de eliminar la obra?',
                                    type: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Si, Eliminar',
                                    cancelButtonText: 'No, Mantener',
                                    confirmButtonClass: 'btn btn-danger',
                                    cancelButtonClass: 'btn btn-default',
                                    buttonsStyling: false
                                  }).then(function(){
                                    submit();
                                  }, function(dismiss){
                                    if(dismiss == 'cancel'){
                                      swal('Cancelado', 'El registro se mantiene','info')
                                    }
                                  })";><span class="glyphicon glyphicon-trash"></span></button>
                                  {{ Form::close()}}
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                              <th>totales</th>
                            </tfoot>
                          </table>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

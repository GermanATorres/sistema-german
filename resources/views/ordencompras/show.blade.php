@extends('layouts.app')

@section('migasdepan')
  <h1>
   Ordenes de compras
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/ordencompras') }}"><i class="fa fa-dashboard"></i> Ordenes de compra</a></li>
    <li class="active">Ver listado</li>
  </ol>
@endsection

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-11">
              <div class="panel panel-primary">
                  <div class="panel-heading">Orden de compra </div>
                  <div class="panel-body">
                      <table width="100%" border="1" rules="groups">
                        <colgroup></colgroup>
                        <colgroup></colgroup>
                        <tbody>
                          <tr>
                            <td>Señores: </td>
                            <td>Orden N°: <b>{{$orden->numero_orden}}</b> </td>
                          </tr>
                          <tr>
                            <td><b>{{$orden->cotizacion->proveedor->nombre}}</b></td>
                            <td>Solicitud N°: <b>{{$orden->cotizacion->presupuestosolicitud->solicitudcotizacion->numero_solicitud}}</b></td>
                          </tr>
                          <tr>
                            <td>NIT:</td>
                            <td>Fecha: <b>{{$orden->created_at->format('d-m-Y')}}</b> </td>
                          </tr>
                          <tr>
                            <td><b>{{$orden->cotizacion->proveedor->nit}}</b></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                      <br>
                      <div class="table-responsive">
                        <table width="100%" border="1" rules="all">
                          <thead>
                            <tr>
                              <th width="5%">N°</th>
                              <th width="50%">DESCRIPCIÓN</th>
                              <th width="10%">UNIDAD DE MEDIDA</th>
                              <th width="10%">CANTIDAD</th>
                              <th width="10%">PRECIO UNITARIO</th>
                              <th width="15%">SUBTOTAL</th>
                              @php
                                $correlativo=0;
                                $total=0.0;
                              @endphp
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($orden->cotizacion->detallecotizacion as $detalle)
                              <tr>
                                @php
                                  $correlativo++;
                                  $total=$total+$detalle->precio_unitario*$detalle->cantidad;
                                @endphp
                                <td><center>{{$correlativo}}</center></td>
                                <td>{{$detalle->descripcion}}</td>
                                <td><center>{{$detalle->unidad_medida}}</center> </td>
                                <td><center>{{$detalle->cantidad}}</center></td>
                                <td><p align="right">${{number_format($detalle->precio_unitario,2)}}</p> </td>
                                <td><p align="right">${{number_format($detalle->precio_unitario*$detalle->cantidad,2)}}</p> </td>
                              </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="6"></td>
                            </tr>
                            <tr>
                              <td colspan="5">Total en letras: <b>{{numaletras($total)}}</b></td>
                              <th><p align="right">${{number_format($total,2)}}</p></th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <br>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th>Observaciones</th>
                            <td>{{$orden->observaciones}}</td>
                          </tr>
                          <tr>
                            <th>Lugar de entrega</th>
                            <td>{{$orden->direccion_entrega}}</td>
                          </tr>
                          <tr>
                            <th>Condición de pago</th>
                            <td>{{$orden->cotizacion->presupuestosolicitud->solicitudcotizacion->formapago->nombre}}</td>
                          </tr>
                          <tr>
                            <th width="40%">Fuente de financiamiento / Proyecto</th>
                            <td width="60%">
                              @foreach($orden->cotizacion->presupuestosolicitud->presupuesto->proyecto->fondo as $fondos)
                                {{$fondos->fondocat->categoria}} /
                              @endforeach
                              {{$orden->cotizacion->presupuestosolicitud->presupuesto->proyecto->nombre}}
                            </td>
                          </tr>
                          <tr>
                            <th>Fecha de entrega</th>
                            <td>
                              @if($orden->fecha_fin == "")
                              {{$orden->fecha_inicio->format('d-m-Y')}}
                            @else
                              del {{$orden->fecha_inicio->format('l d')}} de {{$orden->fecha_inicio->format('F Y')}} al {{$orden->fecha_fin->format('l d')}} de {{$orden->fecha_fin->format('F Y')}}
                            @endif
                            </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

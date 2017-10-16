@extends('layouts.app')

@section('migasdepan')
<h1>
        Contribuyentes

      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contribuyentes') }}"><i class="fa fa-dashboard"></i> Contribuyentes</a></li>
        <li class="active">Listado de contribuyentes</li>
      </ol>
@endsection

@section('content')

<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
              	<a href="{{ url('/contribuyentes/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>
                <a href="{{ url('/contribuyentes?estado=1') }}" class="btn btn-primary">Activos</a>
                <a href="{{ url('/contribuyentes?estado=2') }}" class="btn btn-primary">Papelera</a>
                  {{ Form::open(['route' => 'contribuyentes.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right','role' => 'search'])}}
                <div class="form-group">
                        {{ Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Buscar'])}}
                            {{ Form::hidden('estado') }}
                            <button type="Buscar" class="btn btn-default">Buscar</button>
                </div>
                    {{ Form::close() }}
                </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              @if($estado == 1 || $estado == 0)
              @include('contribuyentes.tabla1')
              @else
              @include('contribuyentes.tabla2')
              @endif
              <script>
                        function baja(id)
                       {
                        swal({
                            title: 'Motivo dar de baja',
                            input: 'text',
                            showCancelButton: true,
                            confirmButtonText: 'Dar de baja',
                            showLoaderOnConfirm: true,
                            allowOutsideClick: false
                          }).then(function (text) {
                            var dominio = window.location.host;
                            var form = $(this).parents('form');
                            $('#baja').attr('action','http://'+dominio+'/contribuyentes/baja/'+id+'+'+text);
                            //document.getElmentById('baja').submit();
                            $('#baja').submit();
                            swal({
                              type: 'success',
                              title: 'Se dio de baja',
                              html: 'Submitted motivo: ' + text
                            })
                          });
                       }

                        function alta(id)
                       {
                        swal({
                            title: 'Dar de alta',
                            showCancelButton: true,
                            confirmButtonText: 'Dar de alta',
                            showLoaderOnConfirm: true,
                            allowOutsideClick: false
                          }).then(function () {
                            var dominio = window.location.host;
                            var form = $(this).parents('form');
                            $('#alta').attr('action','http://'+dominio+'/contribuyentes/alta/'+id);
                            //document.getElmentById('baja').submit();
                            $('#alta').submit();
                            swal({
                              type: 'success',
                              title: 'Se dio de alta',
                              html: 'Submitted motivo: '
                            })
                          });
                       }
                     </script>
              <div class="pull-right">
                 {!! str_replace('/?','?', $contribuyentes->appends(Request::only(['nombre','estado']))->render()) !!}
              </div> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        
@endsection

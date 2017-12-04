@extends('layouts.app')

@section('migasdepan')
    <h1>
        Rubro
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/proyectos') }}"><i class="fa fa-dashboard"></i> Proyectos</a></li>
        <li class="active">Registro</li>      </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro del plan anual de contratación</div>
                <div class="panel-body">
                    {{ Form::open(['action' => 'PaacController@guardar','class' => 'form-horizontal','id' => 'paac']) }}

                    <?php
                    use Carbon\Carbon;
                    $date = Carbon::now();
                    $date = $date->format('Y');
                    ?>
                    <input type="hidden" name="anio" id="anio" value="<?= $date; ?>" readonly>
                    <input type="hidden" name="total" id="total" value="0.00" readonly>
                    <div class="form-group">
                      <label for="" class="col-md-4 control-label">Descripcion plan anual</label>
                        <div class="col-md-6">
                              {{ Form::text('descripcion', null,['class' => 'form-control money','id' => 'sep','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-disk"></span>    Registrar
                            </button>
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! Html::script('js/paac.js') !!}
@endsection

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $guarded = [];

    public static function prestamos()
    {
      $prestamo = Prestamo::where('empleado_id',$id)->first();
    	dd($prestamo->monto);
    	$monto = $prestamo->monto;
      return $monto;
    }

    public function empleado()
    {
      return $this->belongsTo('App\Empleado');
    }
}

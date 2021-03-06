<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\Detallecotizacion;
use App\Proyecto;
use App\Fondo;
use App\Ordencompra;
use App\Presupuesto;
use App\PresupuestoSolicitud;
use App\ProyectoInventario;
use App\Proveedor;
use App\Requisicion;
use App\Requisiciondetalle;
use Illuminate\Http\Request;
use DB;
use App\Formapago;


class OrdencompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

     public function getCotizacion($id)
     {
        $proyecto=Proyecto::findorFail($id);
        $presupuesto=Presupuesto::where('proyecto_id',$proyecto->id)->first();
        $soli=PresupuestoSolicitud::where('presupuesto_id',$presupuesto->id)->first();
        return Cotizacion::where('presupuestosolicitud_id',$soli->id)->where('seleccionado',true)->where('estado',2)->with('proveedor','detallecotizacion')->orderby('id','asc')->get();
     }

     public function getMonto($id)
     {
        return Fondo::where('proyecto_id',$id)->with('fondocat')->get();
     }

     public function requisiciones($id)
     {
       return Requisiciondetalle::where('requisicion_id',$id)->get();
     }

     public function realizarorden($id)
     {
       $solicitud=PresupuestoSolicitud::findorFail($id);
       $presupuesto=Presupuesto::findorFail($solicitud->presupuesto->id);
       $cotizacion=Cotizacion::where('presupuestosolicitud_id',$solicitud->id)->where('seleccionado',true)->where('estado',2)->with('detallecotizacion')->firstorFail();
       return view('ordencompras.create',compact('cotizacion'));
     }

     public function verificar($id)
     {
       $orden=Ordencompra::where('estado',1)->findorFail($id);
       $cotizacion=Cotizacion::findorFail($orden->cotizacion->id);
       $detalles=Detallecotizacion::where('cotizacion_id',$cotizacion->id)->get();
       //dd($cotizacion->presupuestosolicitud->presupuesto->proyecto->id);
       DB::beginTransaction();
       try{
         foreach ($detalles as $detalle) {
           ProyectoInventario::create([
             'descripcion' => $detalle['descripcion'],
             'cantidad' => $detalle['cantidad'],
             'proyecto_id' => $cotizacion->presupuestosolicitud->presupuesto->proyecto->id,
           ]);
         }

         $solicitud=PresupuestoSolicitud::findorFail($cotizacion->presupuestosolicitud->id);
         $solicitud->estado=5;
         $solicitud->save();

         $orden->estado=3;
         $orden->save();

         $presupuesto=Presupuesto::where('proyecto_id',$cotizacion->presupuestosolicitud->presupuesto->proyecto->id)->get();
         foreach($presupuesto as $presu){
           $soli=PresupuestoSolicitud::where('estado',4)->where('presupuesto_id',$presu->id)->count();
         }
         if($soli==0){
           $proyecto=Proyecto::findorFail($cotizacion->presupuestosolicitud->presupuesto->proyecto->id);
           $proyecto->estado=8;
           $proyecto->save();
           DB::commit();
           return redirect('proyectos')->with('mensaje','Materiales recibidos corretamente');
         }
         DB::commit();
         return redirect('ordencompras')->with('mensaje','Materiales recibidos corretamente');


       }catch(\Exception $e){
         DB::rollback();
         return redirect('ordencompras')->with('error','Ocurrió un error consulte al administrador');
       }
     }

    public function index(Request $request)
    {
      //dd(Ordencompra::correlativo());
      $estado = $request->get('estado');
      if( $estado == "" )
      {
        $ordenes = Ordencompra::orderBy('numero_orden')->get();
        return view('ordencompras.index',compact('ordenes','estado'));
      }
      if( $estado == 1 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index',compact('ordenes','estado'));
      }
      if( $estado == 2 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index',compact('ordenes','estado'));
      }
      if( $estado == 3 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index',compact('ordenes','estado'));
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requisiciones = Requisicion::where('estado',1)->get();
        $formapagos = Formapago::all();
        $proveedores = Proveedor::where('estado',1)->get();
        return view('ordencompras.guardar',compact('proveedores','formapagos','requisiciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->All());
        DB::beginTransaction();
        try{
          Ordencompra::create([
              'numero_orden' => Ordencompra::correlativo(),
              'fecha_inicio' => invertir_fecha($request->fecha_inicio),
              'fecha_fin' => invertir_fecha($request->fecha_fin),
              'cotizacion_id' => $request->cotizacion_id,
              'observaciones' => $request->observaciones,
              'direccion_entrega' => $request->direccion_entrega,
              'adminorden' => $request->adminorden,
          ]);
          $cotizacion = Cotizacion::findorFail($request->cotizacion_id);
          $cotizacion->estado=3;
          $cotizacion->save();

          $solicitud=PresupuestoSolicitud::findorFail($cotizacion->presupuestosolicitud->id);
          $solicitud->estado=4;
          $solicitud->save();

          $pre=Presupuesto::where('proyecto_id',$cotizacion->presupuestosolicitud->presupuesto->proyecto->id)->get();
          foreach ($pre as $presi) {
            $soli=PresupuestoSolicitud::where('estado',3)->where('presupuesto_id',$presi->id)->count();
          }
          if($soli==0){
            $proyecto=Proyecto::findorFail($cotizacion->presupuestosolicitud->presupuesto->proyecto->id);
            $proyecto->estado=7;
            $proyecto->save();
            DB::commit();
            return redirect('ordencompras')->with('mensaje','Orden de compra registrada con éxito');
          }

          DB::commit();
          return redirect('solicitudcotizaciones/versolicitudes/'.$cotizacion->presupuestosolicitud->presupuesto->proyecto->id)->with('mensaje','Orden de compra registrada con éxito');
        }catch(\Excention $e){
          DB::rollback();
          return redirect('ordencompras/create')->with('error','ocurrió un error al guardar la orden de compras');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orden = Ordencompra::findorFail($id);
        return view('ordencompras.show',compact('orden'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PresupuestoRequest;
use App\Proyecto;
use App\Presupuesto;
use App\Presupuestodetalle;
use Session;
use DB;

class PresupuestoController extends Controller
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
     
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //$query = 'select proyectos."id",proyectos.nombre from proyectos inner join presupuestos on proyectos."id"=presupuestos."id"';
      //$proyectos = \DB::select(\DB::raw($query));
      $proyectos = Proyecto::all();
        return view('presupuestos.create',compact('proyectos'));
    }

    public function crear($id)
    {
      $proyecto = Proyecto::findorFail($id);
      return view('presupuestos.create',compact('proyecto'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresupuestoRequest $request)
    {
      DB::beginTransaction();
      try{
        $count = $request->contador;
        $presupuesto=Presupuesto::where('proyecto_id',$request->proyecto)->firstorFail();
        //dd($pre);
        $tot=$presupuesto->total;
        //dd($tot);
        $presupuesto->total=$tot+$request->total;
        $presupuesto->save();

          for($i = 0; $i<$count;$i++){
            Presupuestodetalle::create([
              'presupuesto_id' => $presupuesto->id,
              'material' => $request->materiales[$i],
              'cantidad' => $request->cantidades[$i],
              'preciou' => $request->precios[$i],
            ]);
          }
          DB::commit();
          return redirect('proyectos')->with('mensaje','Presupuesto registrado con éxito');
      }catch (\Exception $e){
        DB::rollback();
        Session::flash('error','Presupuesto con error '.$e->getMessage());
        return redirect('/presupuestos/crear/'.$request->proyecto);
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
        //
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

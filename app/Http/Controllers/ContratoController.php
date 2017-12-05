<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contrato;
use App\Tipocontrato;
use App\Bitacora;
use App\Http\Requests\ContratoRequest;

class ContratoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $estado = $request->get('estado');
        if($estado == "" )$estado=1;
        if ($estado == 1) {
            $contratos = Contrato::where('estado',$estado)->get();
            return view('contratos.index',compact('contratos','estado'));
        }
        if ($estado == 2) {
            $contratos = Contrato::where('estado',$estado)->get();
            return view('contratos.index',compact('contratos','estado'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /* $query = 'select tipocontratos."id",tipocontratos.nombre from tipocontratos inner join contratos on tipocontratos."id"=contratos."id"';
      $tipocontratos = \DB::select(\DB::raw($query));*/
      $tipocontratos = Tipocontrato::all();
        return view('contratos.create',compact('tipocontratos'));

        //return view('contratos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratoRequest $request)
    {
        Contrato::create($request->All());
        bitacora('Registró un Contrato');
        return redirect('/contratos')->with('mensaje','Registro almacenado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrato = Contrato::findorFail($id);

        return view('contratos.show', compact('contrato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrato = Contrato::find($id);
        return view('contratos.edit',compact('contrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ContratoRequest $request, $id)
    {
        $contrato = Contrato::find($id);
        $contrato->fill($request->All());
        $contrato->save();
        bitacora('Modificó un Contrato');
        return redirect('/contratos')->with('mensaje','Registro modificado con éxito');
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

    public function baja($cadena)
    {

        $datos = explode("+", $cadena);
        $id=$datos[0];
        $motivo=$datos[1];
        //dd($id);
        $contrato = Contrato::find($id);
        $contrato->estado=2;
        $contrato->motivo=$motivo;
        $contrato->fechabaja=date('Y-m-d');
        $contrato->save();
        bitacora('Dió de baja a un contrato');
        return redirect('/contratos')->with('mensaje','Contrato dado de baja');
    }

    public function alta($id)
    {

        //$datos = explode("+", $cadena);
        ////$id=$datos[0];
        //$motivo=$datos[1];
        //dd($id);
        $contrato = Contrato::find($id);
        $contrato->estado=1;
        $contrato->motivo=null;
        $contrato->fechabaja=null;
        $contrato->save();
        Bitacora::bitacora('Dió de alta a un contrato');
        return redirect('/contratos')->with('mensaje','Contrato dado de alta');
    }
}
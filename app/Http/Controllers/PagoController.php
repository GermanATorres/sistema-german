<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipopago;
use App\Cuenta;
use App\Cuentaproy;
use App\Contribuyente;
use App\Pago;
use App\Bitacora;
use App\Http\Requests\ContratoRequest;

class PagoController extends Controller
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

    public function index(Request $request)
    {
        $pagos = Pago::all();
        return view('pagos.index', compact('pagos'));
    }

    public function guardarCuenta(Request $request)
    {
        if($request->ajax())
        {
            Cuentaproy::create($request->All());
            return response()->json([
                'mensaje' => 'Registro creado']
            );
        }
    }

    public function listarCuentas()
    {
        return Cuenta::where('estado',1)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipopagos = Tipopago::where('estado',1);
        $cuentas = Cuentaproy::all();
        $contribuyentes = Contribuyente::where('estado',1);
        $pagos = Pago::where('estado',1)->get();
        return view('pagos.create',compact('tipopagos','cuentas','contribuyentes','pagos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        Pago::create($request->All());
        return redirect('pagos')->with('mensaje', 'Pago registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pago = Pago::findorFail($id);
        return view('pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pago = Pago::find($id);
        return view('pagos.edit', compact('pago'));
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
        $pago = Pago::find($id);
        $pago->fill($request->All());
        $pago->save();
        bitacora('Modificó registro');
        return redirect('/pagos')->with('mensaje','Registro modificado con éxito');
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

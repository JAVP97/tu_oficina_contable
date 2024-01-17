<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Comuna;
use App\Models\Region;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Factura;
use App\Models\FormaPago;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::paginate(10);
        return view('factura.index', compact('facturas'));
    }
    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $facturas = Factura::paginate(10);
            return view('factura.pagination_data', compact('facturas'))->render();
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $date = \Carbon\Carbon::now();
        $asunto = $date->formatLocalized('%B %Y');
        $clientes = Cliente::all();
        $forma_pago = FormaPago::all();
        return view('factura.create', compact('clientes', 'asunto', 'forma_pago'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        //Temporal Disponible
        $longitud = count($request->cliente_id);

        for($i=0; $i<$longitud; $i++)
        {
            $factura = new Factura();
            $factura->cliente_id = $request->cliente_id[$i];
            $factura->forma_pago_id = $request->forma_pago_id[$i];
            $factura->descripcion_producto = $request->descripcion_producto[$i];
            $factura->cantidad_producto = $request->cantidad_producto[$i];
            $factura->valor_neto = $request->valor_neto[$i];
            $factura->iva = $request->iva[$i];
            $factura->valor_iva = $request->valor_iva[$i];
            $factura->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comuna;
use App\Models\Region;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Factura;
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
        $empresa = Empresa::find(1);
        $clientes = Cliente::all();
        $comunas = Comuna::select('id', 'name', 'region_id')->orderBy('name', 'asc')->get();
        $regiones = Region::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('factura.create', compact('empresa', 'clientes', 'comunas', 'regiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
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

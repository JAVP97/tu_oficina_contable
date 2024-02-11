<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Comuna;
use App\Models\Region;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Factura;
use App\Models\Periodo;
use App\Models\FormaPago;
use Illuminate\Http\Request;
use App\Models\ClientePeriodo;
use Illuminate\Support\Facades\Mail;

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
        $clientes = Cliente::all();
        $forma_pago = FormaPago::all();
        $clientePeriodos = ClientePeriodo::all();
        $periodos = Periodo::orderBy('periodo', 'desc')->get();
        $clientes = Cliente::where('status', 'Activo')->get();
        return view('factura.create', compact('clientes', 'periodos', 'forma_pago', 'clientePeriodos', 'clientes'));
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

            $facturaMail = Factura::find($factura->id);

            //Generar Factura
            $pdf = \PDF::loadView('factura.show')->setPaper("letter");
            $path = public_path('facturas/');
            $fileName = 'Factura #'. $factura->id . '.' . 'pdf';
            $pdf->save($path . '/' . $fileName);

            Mail::send('factura.mail', ['factura' => $facturaMail], function ($m) use ($facturaMail, $path, $fileName) {
                $m->from('test@mail.com', 'Name');
                $m->to('jesus@bcasual.cl', 'Jesus');
                $m->subject('Factura #'. $facturaMail->id );
                $m->attach($path . '/' . $fileName);
            });
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

    public function listadoClientesPeriodos() 
    {   
        $clientePeriodos = ClientePeriodo::select('cliente_periodos.id AS id_cliente_perido', 'cliente_periodos.*', 'c.*', 'p.*')
        ->join('periodos AS p', 'cliente_periodos.periodo_id', 'p.id')
        ->join('clientes AS c', 'cliente_periodos.cliente_id', 'c.id')
        ->get();
        return response()->json($clientePeriodos);
    }

    public function agregarClientesPeriodos(Request $request) 
    { 
        $cliente_periodo = new ClientePeriodo();
        $cliente_periodo->periodo_id = $request->periodo_id;
        $cliente_periodo->cliente_id = $request->cliente_id;
        $cliente_periodo->save();
        
       $clientePeriodos = ClientePeriodo::select('cliente_periodos.id AS id_cliente_perido', 'cliente_periodos.*', 'c.*', 'p.*')
        ->join('periodos AS p', 'cliente_periodos.periodo_id', 'p.id')
        ->join('clientes AS c', 'cliente_periodos.cliente_id', 'c.id')
        ->where('cliente_periodos.periodo_id', $request->periodo_id)
        ->where('c.id', $request->cliente_id)
        ->where('cliente_periodos.id', $cliente_periodo->id)
        ->get();


        return response()->json($clientePeriodos);
    }
}

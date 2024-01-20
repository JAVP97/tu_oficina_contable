<?php

namespace App\Http\Controllers;

use App\Models\Comuna;
use App\Models\Region;
use GuzzleHttp\Client;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Cobranza;
use Illuminate\Http\Request;
use App\Models\OpcionesCliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate(10);
        $comunas = Comuna::select('id', 'name', 'region_id')->orderBy('name', 'asc')->get();
        $regiones = Region::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('clientes.index', compact('clientes', 'comunas', 'regiones'));
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $clientes = Cliente::paginate(10);
            return view('clientes.pagination_data', compact('clientes'))->render();
        }
    }

    public function create()
    {
        $comunas = Comuna::select('id', 'name', 'region_id')->orderBy('name', 'asc')->get();
        $regiones = Region::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('clientes.create', compact('comunas', 'regiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'personalidad' => 'required',
            'nombre_empresa' => 'required',
            'rut_empresa' => 'required|unique:clientes',
            'profesion' => 'required',
            'direccion' => 'required',
            'region_id' => 'required',
            'comuna_id' => 'required',
            'comentario' => 'required',
            'telefono' => 'required',
            'pass_sii' => 'required',
            'tasa_ppm' => 'required',
            'fecha_cobro' => 'required',
            
        ], [
            'personalidad.required' => 'Razon Social es requerido',
            'nombre_empresa' => 'Nombre de la empresa es requerido',
            'rut_cliente.required' => 'RUT es requerido',
            'rut_cliente.unique' => 'El cliente ya existe con este rut',
            'rutdv_cliente.required' => 'Dígito verificador es requerido',
            'profesion.required' => 'Profesion es requerido',
            'direccion.required' => 'Dirección es requerido',
            'region_id.required' => 'Región es requerido',
            'comuna_id.required' => 'Comuna es requerido',
            'comentario.required' => 'Comentario es requerido',
            'telefono.required' => 'Tlf es requerido',
            'pass_sii.required' => 'Contraseña SII es requerido',
            'fecha_cobro.required' => 'Fecha de Cobro es requerido',
        ]);

        $cliente = Cliente::create($validatedData);

        $clienteOpc = new OpcionesCliente;
        $clienteOpc->notificar = $request->notificar;
        $clienteOpc->emails = $request->emails;
        $clienteOpc->exento_iva = $request->exento_iva;
        $clienteOpc->importaciones = $request->importaciones;
        $clienteOpc->remuneraciones = $request->remuneraciones;
        $clienteOpc->contabilidad = $request->contabilidad;
        $clienteOpc->facturacion = $request->facturacion;
        $clienteOpc->cliente_id = $cliente->id;
        $clienteOpc->save(); 
        
        return redirect('clientes')->with('success','Cliente creado con éxito..');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $cliente = Cliente::find($id);
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) 
        {
            //
            $validatedData = $request->validate([
                'personalidad' => 'required',
                'nombre_empresa' => 'required',
                'rut_empresa' => 'required|unique:clientes,rut_empresa,'.$id,
                'profesion' => 'required',
                'direccion' => 'required',
                'region_id' => 'required',
                'comuna_id' => 'required',
                'comentario' => 'required',
                'telefono' => 'required',
                'pass_sii' => 'required',
                'tasa_ppm' => 'required',
                'fecha_cobro' => 'required',
                
            ], [
                'personalidad.required' => 'Razon Social es requerido',
                'nombre_empresa' => 'Nombre de la empresa es requerido',
                'rut_cliente.required' => 'RUT es requerido',
                'rut_cliente.unique' => 'El cliente ya existe con este rut',
                'rutdv_cliente.required' => 'Dígito verificador es requerido',
                'profesion.required' => 'Profesion es requerido',
                'direccion.required' => 'Dirección es requerido',
                'region_id.required' => 'Región es requerido',
                'comuna_id.required' => 'Comuna es requerido',
                'comentario.required' => 'Comentario es requerido',
                'telefono.required' => 'Tlf es requerido',
                'pass_sii.required' => 'Tlf es requerido',
                'fecha_cobro.required' => 'Tlf es requerido',
            ]);

            $cliente = Cliente::find($id);
            $cliente->fill($validatedData)->save();

            return response()->json($cliente);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->back()->with('success', 'Eliminado con exito!');
        
    }

    public function getRegion(Request $request)
    {
        if ($request->ajax()) {
            $comunas = Comuna::where('region_id', $request->region)->get();
            foreach ($comunas as $comuna) {
                $comunasArray[$comuna->id] = $comuna->name;
            }
            return response()->json($comunasArray);
        }
    }
    public function F29() {
        // Auth
        $client = new Client();
        $body = '{
            "apikey": "0823-W110-6387-4295-6224"
        }
        ';
        $response = new \GuzzleHttp\Psr7\Request('GET', 'https://api.simpleapi.cl/api/auth/token', [], $body);
        $token = json_decode((string) $response->getBody(), true);

        $client2 = new Client();

        $credentials = base64_encode('api:'.$token["apikey"]);

        // Proceso
        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => ['Basic '.$credentials],
            ],
            'json' => [
                'RutUsuario' => "26646588-2",
                'PasswordSII' => "17604505gp",
                'RutEmpresa' => "76974835-0",
                'Ambiente' => 1,
                'Detallado' => true
            ]
        ];
        $requests = $client2->request('POST', 'https://servicios.simpleapi.cl/api/RCV/ventas/11/2023', $params);
        return  $responseBody = json_decode((string) $requests->getBody(), true);

        #https://documentacion.simpleapi.cl/#auth-info-e7b925f6-cf4d-4a7a-acde-7d3ebf1e2866
    }

    public function getClientes(Request $request)
    {
        if ($request->ajax()) {
            $clientes = Cliente::select('clientes.*', 'r.name as region', 'c.name as comuna')
            ->join('regions as r', 'clientes.region_id', 'r.id')
            ->join('comunas as c', 'clientes.comuna_id', 'c.id')
            ->where('clientes.id', $request->id_cliente)->get();
            return response()->json($clientes);
        }
    }

    public function GenerarCobranza(Request $request, $id){
        if ($request->ajax()) {
            $cobranza = new Cobranza();
            $cobranza->cliente_id = $id;
            $cobranza->forma_pago_id = $request->forma_pago_id;
            $cobranza->descripcion = $request->descripcion_producto;
            $cobranza->cantidad = $request->cantidad_producto;
            $cobranza->valor_neto = $request->valor_neto;
            $cobranza->iva = $request->iva;
            $cobranza->valor_iva = $request->valor_iva;
            $cobranza->save();
    
            $cobranzaMail = Cobranza::find($cobranza->id);
    
            //Generar Factura
            $pdf = \PDF::loadView('cobranzas.show', ['data' => $cobranzaMail])->setPaper("letter");
            $path = public_path('cobranza/');
            $fileName = 'Factura #'. $cobranza->id . '.' . 'pdf';
            $pdf->save($path . '/' . $fileName);
    
            Mail::send('cobranzas.mail', ['cobranza' => $cobranzaMail], function ($m) use ($cobranzaMail, $path, $fileName) {
                $m->from('test@mail.com', 'Name');
                $m->to('jesus@bcasual.cl', 'Jesus');
                $m->subject('Factura #'. $cobranzaMail->id );
                $m->attach($path . '/' . $fileName);
            });
        }
        

        return redirect()->back();
    }
    public function GenerarFactura(Request $request, $id){
        
    }
}

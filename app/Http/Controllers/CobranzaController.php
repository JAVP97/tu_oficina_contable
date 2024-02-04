<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Cobranza;
use App\Models\FormaPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CobranzaController extends Controller
{
    public function index()
    {
        $cobranzas = Cobranza::paginate(10);
        return view('cobranzas.index', compact('cobranzas'));
    }
    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $cobranzas = Cobranza::paginate(10);
            return view('cobranzas.pagination_data', compact('cobranzas'))->render();
        }
    }
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        //
    }
    public function show(Cobranza $cobranza)
    {
        
        $data = Cobranza::find($cobranza->id);
        $empresa = Empresa::find(1);
        // return view('cobranzas.mail', compact('data', 'empresa'));
        $view =  \View::make('cobranzas.show', compact('data', 'empresa'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('Cobranza '. $empresa->razon_social .'#'.$cobranza->id.'.pdf');
    }
    public function EnviarMailCobranza(Request $request, $id){
        $cobranzaMail = Cobranza::find($id);

        //Generar Factura
        $pdf = \PDF::loadView('cobranzas.show', ['data' => $cobranzaMail, 'empresa' => Empresa::find(1)])->setPaper("letter");
        $path = public_path('cobranza/');
        $fileName = 'Cobranza '. $cobranzaMail->cliente->nombre_empresa .' #'. $id . '.' . 'pdf';
        $pdf->save($path . '/' . $fileName);
        Mail::send('cobranzas.mail', ['data' => $cobranzaMail, 'empresa' => Empresa::find(1)], function ($m) use ($cobranzaMail, $path, $fileName) {
            $m->from('test@mail.com', 'Name');
            $m->to('jesus@bcasual.cl', 'Jesus');
            $m->subject('Cobranza '. $cobranzaMail->cliente->nombre_empresa .' #'. $cobranzaMail->id );
            $m->attach($path . '/' . $fileName);
        });

        return redirect()->back()->with('success', 'Cobranza enviada por mail.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cobranza $cobranza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cobranza $cobranza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cobranza $cobranza)
    {
        //
    }
}

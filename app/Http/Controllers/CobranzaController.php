<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Cobranza;
use App\Models\FormaPago;
use Illuminate\Http\Request;

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

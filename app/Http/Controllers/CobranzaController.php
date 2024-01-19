<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cobranza;
use App\Models\FormaPago;
use Illuminate\Http\Request;

class CobranzaController extends Controller
{
    public function index()
    {
        $cobranzas = Cobranza::paginate(10);
        return view('cobranza.index', compact('cobranzas'));
    }
    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $cobranzas = Cobranza::paginate(10);
            return view('cobranza.pagination_data', compact('cobranzas'))->render();
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
        //
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

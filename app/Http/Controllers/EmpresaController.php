<?php

namespace App\Http\Controllers;

use App\Models\Comuna;
use App\Models\Region;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::paginate(10);
        return view('empresa.index', compact('empresas'));
    }
    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $empresas = Empresa::paginate(10);
            return view('empresa.pagination_data', compact('empresas'))->render();
        }
    }
    public function create()
    {
        $comunas = Comuna::select('id', 'name', 'region_id')->orderBy('name', 'asc')->get();
        $regiones = Region::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('empresa.create', compact('comunas', 'regiones'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'razon_social' => 'required',
            'direccion_empresa'  => 'required',
            'rut_empresa'  => 'required',
            'email_empresa' => 'required|email',
            'region_id' => 'required',
            'comuna_id' => 'required',
            'tipo_venta' => 'required',
            'telefono_empresa' => '',
            'giro_empresa' => 'required',
            'act_econo_empresa' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('empresa/create')
                ->withErrors($validator);
        } else {
            // store
            $empresa = new Empresa;
            $empresa->razon_social = $request->razon_social;
            $empresa->rut_empresa = $request->rut_empresa;
            $empresa->direccion_empresa = $request->direccion_empresa;
            $empresa->email_empresa = $request->email_empresa;
            $empresa->region_id = $request->region_id;
            $empresa->comuna_id = $request->comuna_id;
            $empresa->tipo_venta = $request->tipo_venta;
            $empresa->telefono_empresa = $request->telefono_empresa;
            $empresa->giro_empresa = $request->giro_empresa;
            $empresa->act_econo_empresa = $request->act_econo_empresa;
            $empresa->save();

            return redirect('empresa')->with('success','Empresa creado con éxito..');
        }
    }
    public function edit(Empresa $empresa)
    {
        $comunas = Comuna::select('id', 'name', 'region_id')->orderBy('name', 'asc')->get();
        $regiones = Region::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('empresa.edit', compact('comunas', 'regiones', 'empresa'));
    }
    public function update(Request $request, Empresa $empresa)
    {
        $rules = array(
            'razon_social' => 'required',
            'direccion_empresa'  => 'required',
            'rut_empresa'  => 'required',
            'email_empresa' => 'required|email',
            'region_id' => 'required',
            'comuna_id' => 'required',
            'tipo_venta' => 'required',
            'telefono_empresa' => '',
            'giro_empresa' => 'required',
            'act_econo_empresa' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('empresa/create')
                ->withErrors($validator);
        } else {
            // store
            $empresa = Empresa::find($empresa->id);
            $empresa->razon_social = $request->razon_social;
            $empresa->rut_empresa = $request->rut_empresa;
            $empresa->direccion_empresa = $request->direccion_empresa;
            $empresa->email_empresa = $request->email_empresa;
            $empresa->region_id = $request->region_id;
            $empresa->comuna_id = $request->comuna_id;
            $empresa->tipo_venta = $request->tipo_venta;
            $empresa->telefono_empresa = $request->telefono_empresa;
            $empresa->giro_empresa = $request->giro_empresa;
            $empresa->act_econo_empresa = $request->act_econo_empresa;
            $empresa->save();

            return redirect('empresa')->with('success','Informacion de empresa actualizado con éxito..');
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public $validacion = [
        "nombre" => "required",
        "paterno" => "nullable",
        "materno" => "nullable",
        "ci" => "required|min:4|unique:clientes,ci",
        "ci_exp" => "required",
        "fecha_nacimiento" => "required|date",
        "edad" => "required|numeric",
        "genero" => "required|min:1",
        "sucursal_id" => "required",
    ];

    public $mensajes = [
        'sucursal_id.required' => 'Este campo es obligatorio',
    ];

    public function index(Request $request)
    {
        $clientes = Cliente::with("sucursal")->get();
        return response()->JSON(['clientes' => $clientes, 'total' => count($clientes)], 200);
    }

    public function clientes_sucursal(Request $request)
    {
        $clientes = Cliente::with("sucursal")->where("sucursal_id", $request->id)->get();
        return response()->JSON($clientes);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $this->validacion['foto'] = 'image|mimes:jpeg,jpg,png|max:2048';
        }

        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        // CREAR EL USER
        $nuevo_cliente = Cliente::create(array_map('mb_strtoupper', $request->except('foto')));

        $nuevo_cliente->foto = 'default.png';
        if ($request->hasFile('foto')) {
            $file = $request->foto;
            $nom_foto = time() . '_' . $nuevo_cliente->cliente . '.' . $file->getClientOriginalExtension();
            $nuevo_cliente->foto = $nom_foto;
            $file->move(public_path() . '/imgs/clientes/', $nom_foto);
        }

        $nuevo_cliente->save();
        return response()->JSON([
            'sw' => true,
            'cliente' => $nuevo_cliente,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $this->validacion['ci'] = 'required|min:4|unique:clientes,ci,' . $cliente->id;
        if ($request->hasFile('foto')) {
            $this->validacion['foto'] = 'image|mimes:jpeg,jpg,png|max:2048';
        }

        $request->validate($this->validacion, $this->mensajes);
        $cliente->update(array_map('mb_strtoupper', $request->except('foto', 'password')));

        if ($request->hasFile('foto')) {
            $antiguo = $cliente->foto;
            if ($antiguo != 'default.png') {
                \File::delete(public_path() . '/imgs/clientes/' . $antiguo);
            }
            $file = $request->foto;
            $nom_foto = time() . '_' . $cliente->cliente . '.' . $file->getClientOriginalExtension();
            $cliente->foto = $nom_foto;
            $file->move(public_path() . '/imgs/clientes/', $nom_foto);
        }
        $cliente->save();
        return response()->JSON([
            'sw' => true,
            'cliente' => $cliente,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Cliente $cliente)
    {
        return response()->JSON([
            'sw' => true,
            'cliente' => $cliente
        ], 200);
    }

    public function destroy(Cliente $cliente)
    {
        $antiguo = $cliente->foto;
        if ($antiguo != 'default.png') {
            \File::delete(public_path() . '/imgs/clientes/' . $antiguo);
        }
        $cliente->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}

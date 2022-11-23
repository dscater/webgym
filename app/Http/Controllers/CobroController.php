<?php

namespace App\Http\Controllers;

use App\Models\Cobro;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class CobroController extends Controller
{
    public $validacion = [
        "cliente_id" => "required",
        "inscripcion_id" => "required",
        "sucursal_id" => "required",
        "fecha_cobro" => "required|date",
    ];

    public $messages = [
        "cliente_id.required" => "Debes seleccionar una cliente",
        "sucursal_id.required" => "Debes seleccionar una sucursal",
        "fecha_cobro.required" => "Debes indicar una fecha de cobro",
        "fecha_cobro.date" => "Debes indicar una fecha de cobro valido",
        "inscripcion_id.required" => "Debe existir una inscripción con un cobro Pendiente"
    ];

    public function index()
    {
        $cobros = Cobro::with("sucursal")->with("cliente")->get();
        return response()->JSON(["cobros" => $cobros, "total" => count($cobros)]);
    }

    public function cobros_sucursal(Request $request)
    {
        $cobros = Cobro::with("sucursal")->where("sucursal_id", $request->id)->get();
        return response()->JSON($cobros);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->messages);
        $request["fecha_registro"] = date("Y-m-d");

        $inscripcion = Inscripcion::find($request->inscripcion_id);
        Cobro::create(array_map("mb_strtoupper", $request->all()));
        $inscripcion->estado_cobro = "COMPLETO";
        $inscripcion->save();

        return response()->JSON(["sw" => true, "msj" => "El registro se almacenó correctamente"]);
    }

    public function show(Cobro $cobro)
    {
        return response()->JSON($cobro);
    }

    public function update(Cobro $cobro, Request $request)
    {
        $request->validate($this->validacion, $this->messages);
        $cobro->update(array_map("mb_strtoupper", $request->all()));
        return response()->JSON(["sw" => true, "cobro" => $cobro, "msj" => "El registro se actualizó correctamente"]);
    }

    public function destroy(Cobro $cobro)
    {
        $cobro->inscripcion->estado_cobro = "PENDIENTE";
        $cobro->inscripcion->save();
        $cobro->delete();
        return response()->JSON(["sw" => true, "cobro" => $cobro, "msj" => "El registro se actualizó correctamente"]);
    }
}

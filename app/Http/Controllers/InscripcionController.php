<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Plan;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public $validacion = [
        "cliente_id" => "required",
        "plan_id" => "required",
        "sucursal_id" => "required",
        "fecha_inscripcion" => "required",
        "codigo_rfid" => "required|unique:inscripcions,codigo_rfid",
    ];

    public function index()
    {
        $inscripcions = Inscripcion::with('cliente')
            ->with('plan')
            ->with('sucursal')
            ->get();
        return response()->JSON(["inscripcions" => $inscripcions, "total" => count($inscripcions)]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion);
        $inscripcion_vigente = Inscripcion::where("sucursal_id", $request->sucursal_id)
            ->where("cliente_id", $request->cliente_id)
            ->where("fecha_fin", ">=", $request->fecha_inscripcion)
            ->get()
            ->first();
        if ($inscripcion_vigente) {
            return response()->JSON(["sw" => false, "msj" => "El cliente ya cuenta con una inscripción vigente en la sucursal seleccionada dentro de la fecha de inscripción indicada"]);
        }

        $inscripcion_pendiente =  Inscripcion::where("cliente_id", $request->cliente_id)
            ->where("estado_cobro", "PENDIENTE")
            ->get();
        if (count($inscripcion_pendiente) > 0) {
            $sucursales = "";
            foreach ($inscripcion_pendiente as $ins) {
                $sucursales .= $ins->sucursal->nombre . ", ";
            }
            return response()->JSON(["sw" => false, "msj" => "El cliente tiene COBROS PENDIENTES en las siguentes sucursales: " . $sucursales . "debe realizar los pagos para realizar una inscripción"]);
        }


        $request["fecha_registro"] = date("Y-m-d");
        $request["estado_cobro"] = "PENDIENTE";
        $plan = Plan::find($request->plan_id);
        $request["fecha_fin"] = date("Y-m-d", strtotime($request->fecha_inscripcion . " +" . $plan->duracion . "days"));
        Inscripcion::create(array_map("mb_strtoupper", $request->all()));
        return response()->JSON(["sw" => true, "msj" => "El registro se almacenó correctamente"]);
    }

    public function show(Inscripcion $inscripcion)
    {
        return response()->JSON($inscripcion);
    }

    public function update(Inscripcion $inscripcion, Request $request)
    {
        $this->validacion['codigo_rfid'] = 'required|unique:inscripcions,codigo_rfid,' . $inscripcion->id;
        $request->validate($this->validacion);
        $inscripcion_vigente = Inscripcion::where("sucursal_id", $request->sucursal_id)
            ->where("cliente_id", $request->cliente_id)
            ->where("fecha_fin", ">=", $request->fecha_inscripcion)
            ->where("id", "!=", $inscripcion->id)
            ->get()
            ->first();
        if ($inscripcion_vigente) {
            return response()->JSON(["sw" => false, "msj" => "El cliente ya cuenta con una inscripción vigente en la sucursal seleccionada dentro de la fecha de inscripción indicada"]);
        }
        $plan = Plan::find($request->plan_id);
        $request["fecha_fin"] = date("Y-m-d", strtotime($request->fecha_inscripcion . " +" . $plan->duracion . "days"));
        $inscripcion->update(array_map("mb_strtoupper", $request->all()));
        return response()->JSON(["sw" => true, "inscripcion" => $inscripcion, "msj" => "El registro se actualizó correctamente"]);
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return response()->JSON(["sw" => true, "inscripcion" => $inscripcion, "msj" => "El registro se actualizó correctamente"]);
    }

    public function getInfoInscripcion(Request $request)
    {
        $cliente_id = $request->cliente_id;
        $sucursal_id = $request->sucursal_id;

        $inscripcion = Inscripcion::with("cliente")->with("sucursal")->with("plan")
            ->where("cliente_id", $cliente_id)
            ->where("sucursal_id", $sucursal_id)
            ->where("estado_cobro", "PENDIENTE")
            ->orderBy("fecha_inscripcion", "desc")
            ->get()
            ->first();

        return response()->JSON($inscripcion);
    }
}

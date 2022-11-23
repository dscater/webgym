<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class AccesoController extends Controller
{

    public function index()
    {
        $accesos = Acceso::with("cliente")->with("sucursal")->orderBy("fecha_registro", "desc")->get();
        return response()->JSON(['accesos' => $accesos, 'total' => count($accesos)], 200);
    }

    public function store(Request $request)
    {
        $rfid = $request->rfid;
        $fecha = date("Y-m-d");
        $accion = "";
        $inscripcion = Inscripcion::where("codigo_rfid", $rfid)->get()->first();
        if ($inscripcion) {
            if ($inscripcion->fecha_fin >= $fecha) {
                $existe_ingreso = Acceso::where("cliente_id", $inscripcion->cliente_id)->where("fecha_registro", $fecha)->where("tipo", "INGRESO")->get()->first();
                $existe_salida = Acceso::where("cliente_id", $inscripcion->cliente_id)->where("fecha_registro", $fecha)->where("tipo", "SALIDA")->get()->first();
                if (!$existe_ingreso && !$existe_salida) {
                    Acceso::create([
                        "cliente_id" => $inscripcion->cliente_id,
                        "sucursal_id" => $inscripcion->sucursal_id,
                        "tipo" => "INGRESO",
                        "fecha_registro" => $fecha
                    ]);
                    $accion = "INGRESO";
                } elseif ($existe_ingreso && !$existe_salida) {
                    Acceso::create([
                        "cliente_id" => $inscripcion->cliente_id,
                        "sucursal_id" => $inscripcion->sucursal_id,
                        "tipo" => "SALIDA",
                        "fecha_registro" => $fecha
                    ]);
                    $accion = "SALIDA";
                } elseif ($existe_ingreso && $existe_salida) {
                    return response()->JSON([
                        "sw" => true,
                        "accion" => "",
                        "img" => '<img src="' . $inscripcion->cliente->path_image . '">',
                        "msj" => $inscripcion->cliente->full_name . "<br>Ya registró su Ingreso y Salida el día de hoy"
                    ]);
                }

                return response()->JSON([
                    "sw" => true,
                    "accion" => $accion,
                    "img" => '<img src="' . $inscripcion->cliente->full_name . '">',
                    "msj" => $inscripcion->cliente->full_name
                ]);
            } else {
                return response()->JSON([
                    "sw" => false,
                    "msj" => "La inscripción del código que ingreso caducó el " . date("d/m/Y", strtotime($inscripcion->fecha_fin))
                ]);
            }
        }

        return response()->JSON([
            "sw" => false,
            "msj" => "No se encontró ninguna inscripción con ese código, intente nuevamente por favor"
        ]);
    }
}

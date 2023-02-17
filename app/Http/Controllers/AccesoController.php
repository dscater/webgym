<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use App\Models\Inscripcion;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccesoController extends Controller
{

    public function index()
    {
        $accesos = Acceso::with("cliente")->with("sucursal")->orderBy("fecha_registro", "desc")->get();
        if (Auth::user()->tipo != 'GERENTE') {
            $accesos = Acceso::with("cliente")->with("sucursal")->where("sucursal_id", Auth::user()->sucursal_id)->orderBy("fecha_registro", "desc")->get();
        }

        return response()->JSON(['accesos' => $accesos, 'total' => count($accesos)], 200);
    }

    public function store(Request $request)
    {
        $rfid = $request->rfid;
        $fecha = date("Y-m-d");
        $accion = "";
        $inscripcion = Inscripcion::where("codigo_rfid", $rfid)->get()->first();

        if (!$inscripcion) {
            return response()->JSON([
                "sw" => false,
                "message" => "No existe ningún registro con ese RFID",
                "msj" => "No se encontró ninguna inscripción con ese código, intente nuevamente por favor",
                "errors" => [
                    "rfid" => ["No existe ningún registro con ese código"]
                ]
            ], 422);
        }

        $sucursal = Sucursal::find($request->sucursal_id);
        if ($inscripcion->plan->todos == 'NO') {
            if ($inscripcion->sucursal_id != $request->sucursal_id) {
                return response()->JSON([
                    "sw" => false,
                    "msj" => "El código que ingreso no pertenece a la sucursal " . $sucursal->nombre
                ]);
            }
        }
        if ($inscripcion) {
            if ($inscripcion->fecha_fin >= $fecha) {
                if ($inscripcion->pausa == 0) {
                    // COMPROBAR INGRESO/SALIDA
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
                            "msj" => '<strong class="text-xl">' . $inscripcion->disciplina . '</strong><br/>' . $inscripcion->cliente->full_name . '<br/>' . $inscripcion->cliente->full_ci . '<br/><strong>Fecha vencimiento: </strong>' . date("d/m/Y", strtotime($inscripcion->fecha_fin)) . '<br/>' . $inscripcion->sucursal->nombre . '<br><strong><i class="text-md">Ya registró su Ingreso y Salida el día de hoy</i></strong>'
                        ]);
                    }

                    return response()->JSON([
                        "sw" => true,
                        "accion" => $accion,
                        "img" => '<img src="' . $inscripcion->cliente->path_image . '">',
                        "msj" => '<strong class="text-xl">' . $inscripcion->disciplina . '</strong><br/>' . $inscripcion->cliente->full_name . '<br/>' . $inscripcion->cliente->full_ci . '<br/><strong>Fecha vencimiento: </strong>' . date("d/m/Y", strtotime($inscripcion->fecha_fin)) . '<br/>' . $inscripcion->sucursal->nombre
                    ]);
                } else {
                    // INSCRIPCIÓN PAUSADA
                    return response()->JSON([
                        "sw" => false,
                        "msj" => "La inscripción se pauso el " . date("d/m/Y", strtotime($inscripcion->fecha_pausa))
                    ]);
                }
            } else {
                // INSCRIPCION TERMINADA/CADUCADA
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

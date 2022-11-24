<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionFisica;
use Illuminate\Http\Request;

class EvaluacionFisicaController extends Controller
{
    public $validacion = [
        'cliente_id' => 'required',
        'sucursal_id' => 'required',
    ];

    public function index()
    {
        $evaluacion_fisicas = EvaluacionFisica::with("cliente")->get();
        return response()->JSON(["evaluacion_fisicas" => $evaluacion_fisicas, "total" => count($evaluacion_fisicas)]);
    }

    public function store(Request $request)
    {
        $existe_evaluacion = EvaluacionFisica::where("cliente_id", $request->cliente_id)->get()->first();
        if ($existe_evaluacion) {
            return response()->JSON(["sw" => false, "msj" => "El cliente seleccionado ya cuenta con una evaluación física registrada"]);
        }

        $request->validate($this->validacion);
        $evaluacion_fisica = EvaluacionFisica::create(array_map("mb_strtoupper", $request->except(
            "pliegues",
            "perimetrias",
            "imcs"
        )));
        $pliegues = $request->pliegues;
        $perimetrias = $request->perimetrias;
        $imcs = $request->imcs;
        $evaluacion_fisica->pliegues()->create($pliegues);
        $evaluacion_fisica->perimetrias()->create($perimetrias);
        $evaluacion_fisica->imcs()->create($imcs);

        return response()->JSON(["sw" => true, "msj" => "El registro se almacenó correctamente", "id" => $evaluacion_fisica->id]);
    }

    public function show(EvaluacionFisica $evaluacion_fisica)
    {
        return response()->JSON($evaluacion_fisica->load(["pliegues", "perimetrias", "imcs"]));
    }

    public function update(EvaluacionFisica $evaluacion_fisica, Request $request)
    {
        $existe_evaluacion = EvaluacionFisica::where("cliente_id", $request->cliente_id)->where("id", "!=", $evaluacion_fisica->id)->get()->first();
        if ($existe_evaluacion) {
            return response()->JSON(["sw" => false, "msj" => "El cliente seleccionado ya cuenta con una evaluación física registrada"]);
        }

        $request->validate($this->validacion);
        $evaluacion_fisica->update(array_map("mb_strtoupper", $request->except(
            "pliegues",
            "perimetrias",
            "imcs"
        )));

        $pliegues = $request->pliegues;
        $perimetrias = $request->perimetrias;
        $imcs = $request->imcs;
        $evaluacion_fisica->pliegues->update($pliegues);
        $evaluacion_fisica->perimetrias->update($perimetrias);
        $evaluacion_fisica->imcs->update($imcs);

        return response()->JSON(["sw" => true, "evaluacion_fisica" => $evaluacion_fisica, "msj" => "El registro se actualizó correctamente"]);
    }

    public function destroy(EvaluacionFisica $evaluacion_fisica)
    {
        $evaluacion_fisica->pliegues()->delete();
        $evaluacion_fisica->perimetrias()->delete();
        $evaluacion_fisica->imcs()->delete();
        $evaluacion_fisica->delete();
        return response()->JSON(["sw" => true, "evaluacion_fisica" => $evaluacion_fisica, "msj" => "El registro se actualizó correctamente"]);
    }
}

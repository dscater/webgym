<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public $validacion = [
        "sucursal_id" => "required",
        "cliente_id" => "required",
        "total" => "required",
        "fecha" => "required|date",
    ];

    public function index()
    {
        $ventas = Venta::with("sucursal")->with("cliente")->get();
        return response()->JSON(["ventas" => $ventas, "total" => count($ventas)]);
    }

    public function ventas_sucursal(Request $request)
    {
        $ventas = Venta::with("sucursal")->where("sucursal_id", $request->id)->get();
        return response()->JSON($ventas);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion);
        $request["fecha_registro"] = date("Y-m-d");
        $venta = Venta::create(array_map("mb_strtoupper", $request->except("detalle_ventas")));

        $detalle_ventas = $request->detalle_ventas;
        foreach ($detalle_ventas as $value) {
            $dv = $venta->detalle_ventas()->create([
                "producto_id" => $value["producto_id"],
                "cantidad" => $value["cantidad"],
                "precio" => $value["precio"],
                "subtotal" => $value["subtotal"],
            ]);
            $producto = Producto::find($dv->producto_id);
            $producto->stock_actual = (float) $producto->stock_actual - (float)$dv->cantidad;
            $producto->salidas = (float) $producto->salidas + (float)$dv->cantidad;
            $producto->save();
        }

        return response()->JSON(["sw" => true, "venta" => $venta, "id" => $venta->id, "msj" => "El registro se almacenó correctamente"]);
    }

    public function show(Venta $venta)
    {
        return response()->JSON($venta->load("detalle_ventas.producto"));
    }

    public function update(Venta $venta, Request $request)
    {
        $request->validate($this->validacion);
        $venta->update(array_map("mb_strtoupper", $request->except("detalle_ventas", "eliminados")));
        $detalle_ventas = $request->detalle_ventas;
        foreach ($detalle_ventas as $value) {
            if ($value["id"] == 0) {
                $dv = $venta->detalle_ventas()->create([
                    "producto_id" => $value["producto_id"],
                    "cantidad" => $value["cantidad"],
                    "precio" => $value["precio"],
                    "subtotal" => $value["subtotal"],
                ]);
                $producto = Producto::find($dv->producto_id);
                $producto->stock_actual = (float) $producto->stock_actual - (float)$dv->cantidad;
                $producto->salidas = (float) $producto->salidas + (float)$dv->cantidad;
                $producto->save();
            }
        }

        $eliminados = $request->eliminados;
        foreach ($eliminados as $value) {
            $dv = DetalleVenta::find($value);
            $producto = Producto::find($dv->producto_id);
            $producto->stock_actual = (float) $producto->stock_actual + (float)$dv->cantidad;
            $producto->salidas = (float) $producto->salidas - (float)$dv->cantidad;
            $producto->save();
            $dv->delete();
        }

        return response()->JSON(["sw" => true, "venta" => $venta, "id" => $venta->id, "msj" => "El registro se actualizó correctamente"]);
    }

    public function destroy(Venta $venta)
    {
        foreach ($venta->detalle_ventas as $dv) {
            $producto = Producto::find($dv->producto_id);
            $producto->stock_actual = (float) $producto->stock_actual + (float)$dv->cantidad;
            $producto->salidas = (float) $producto->salidas - (float)$dv->cantidad;
            $producto->save();
            $dv->delete();
        }

        $venta->delete();
        return response()->JSON(["sw" => true, "venta" => $venta, "msj" => "El registro se actualizó correctamente"]);
    }
}

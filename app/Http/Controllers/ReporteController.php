<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class ReporteController extends Controller
{
    public function usuarios(Request $request)
    {
        $request->validate(['sucursal_id' => 'required']);

        $sucursal_id =  $request->sucursal_id;
        $filtro =  $request->filtro;
        $usuarios = User::where('id', '!=', 1)->where("sucursal_id", $sucursal_id)->get();
        if ($filtro == 'Rango de fechas') {
            $request->validate([
                'fecha_ini' => 'required|date',
                'fecha_fin' => 'required|date',
            ]);
            $usuarios = User::where('id', '!=', 1)->where("sucursal_id", $sucursal_id)->whereBetween('fecha_registro', [$request->fecha_ini, $request->fecha_fin])->get();
        }

        if ($filtro == 'Tipo de usuario') {
            $request->validate([
                'tipo' => 'required',
            ]);
            $usuarios = User::where('id', '!=', 1)->where("sucursal_id", $sucursal_id)->where('tipo', $request->tipo)->get();
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('Usuarios.pdf');
    }

    public function clientes(Request $request)
    {
        $sucursal_id =  $request->sucursal_id;
        $filtro =  $request->filtro;
        $clientes = Cliente::where("sucursal_id", $sucursal_id)->get();
        if ($filtro == 'Rango de fechas') {
            $request->validate([
                'fecha_ini' => 'required|date',
                'fecha_fin' => 'required|date',
            ]);
            $clientes = Cliente::where("sucursal_id", $sucursal_id)->whereBetween('fecha_registro', [$request->fecha_ini, $request->fecha_fin])->get();
        }

        $pdf = PDF::loadView('reportes.clientes', compact('clientes'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->download('clientes.pdf');
    }
    public function empleados(Request $request)
    {
    }
    public function maquinas(Request $request)
    {
    }
    public function mantenimiento_maquinas(Request $request)
    {
    }
    public function inscripcions(Request $request)
    {
    }
    public function accesos(Request $request)
    {
    }
    public function cobros(Request $request)
    {
    }
    public function productos(Request $request)
    {
    }
    public function ingreso_productos(Request $request)
    {
    }
    public function stock_productos(Request $request)
    {
    }
    public function venta_productos(Request $request)
    {
    }
    public function grafico_ventas(Request $request)
    {
    }
    public function grafico_cobros(Request $request)
    {
    }
}

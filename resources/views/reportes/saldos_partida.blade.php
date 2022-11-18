<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SaldosPartida</title>
    <style type="text/css">
        * {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        @page {
            margin-top: 1.5cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            font-size: 9pt;
        }

        .logo {
            top: 0;
            left: 0;
            height: 100px;
            width: 200px;
        }

        .titulo {
            position: absolute;
            width: 350px;
            font-weight: bold;
            font-size: 1.5rem;
            text-align: center;
            padding: 3px;
            left: 35%;
            top: 20px;
        }

        .correlativo {
            width: 120px;
            position: absolute;
            right: 0px;
            top: 10px;
        }

        .nro {
            border: solid 1px;
            padding: 4px;
        }

        .gray {
            background: #F2F2F2;
        }

        .bold {
            font-weight: bold;
        }

        table {
            width: 100%;
            margin: auto;
        }

        .solicitante {
            border-collapse: collapse;
        }

        .solicitante tbody tr td {
            padding: 4px;
        }

        .centreado {
            text-align: center;
        }

        .border {
            border: solid 1px black;
        }

        .firma {
            height: 45px;
            width: 80%;
            margin: auto;
            border: solid 1px;
        }

        .p-0 {
            padding: 0px;
        }

        .p-5 {
            padding: 5px;
        }

        .datos_solicitante {
            width: 48%;
            margin-left: 0px;
            margin-top: 15px;
        }

        .datos_superior {
            position: absolute;
            width: 48%;
            margin-right: 0px;
            top: 147px;
        }

        .bg_principal {
            background: #0062A5;
            color: white;
        }

        .sigep {
            border-collapse: collapse;
            width: 35%;
            margin-left: 0px;
            margin-top: 15px;
        }

        .sigep tbody tr td {
            padding: 5px;
        }

        .inicio,
        .final {
            position: absolute;
            width: 20%;
            border-collapse: collapse;
        }

        .inicio {
            top: 350px;
            right: -100px;
        }

        .final {
            top: 350px;
            right: -250px;
        }

        .collapse {
            border-collapse: collapse;
        }

        .text_right {
            text-align: right;
        }

        .texto_unidad {
            width: 50%;
            margin-top: 55px;
            margin-left: auto;
            text-align: right;
        }

        .tabla_detalle thead tr th,
        .tabla_detalle tbody tr td {
            font-size: 0.7rem;
        }

        .tabla_detalle tbody tr td {
            padding: 2px;
        }

        .salto_linea {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @php
        $contador = 0;
    @endphp
    @inject('configuracion', 'App\Models\Configuracion')
    @inject('o_certificacion', 'App\Models\Certificacion')
    <img class="logo" src="{{ asset('imgs/' . $configuracion->first()->logo) }}" alt="Logo">
    <div class="titulo">SALDOS DE PRESUPUESTOS POR ACTIVIDAD<br />GESTIÓN {{ date('Y') }}</div>
    <table border="1" class="collapse">
        <tbody>
            <tr class="bg_principal">
                <td class="bold p-5" width="10%">Código PEI:</td>
                <td class="bold p-5">{{ $memoria_operacion->operacion->detalle_formulario->formulario->codigo_pei }}
                </td>
            </tr>
            <tr>
                <td class="bold p-5">Código operación:</td>
                <td class="bold p-5">{{ $memoria_operacion->codigo_operacion }}</td>
            </tr>
            <tr>
                <td class="bold p-5">Actividad:</td>
                <td class="bold p-5">{{ $memoria_operacion->descripcion_actividad }}</td>
            </tr>
            <tr>
                <td class="bold p-5">Partida:</td>
                <td class="bold p-5">{{ $memoria_operacion->partida }}</td>
            </tr>
        </tbody>
    </table>

    <table class="collapse tabla_detalle" border="1">
        <thead>
            <tr>
                <th rowspan="2" width="5%">
                    Código tarea
                </th>
                <th rowspan="2">
                    Actividad/Tareas
                </th>
                <th rowspan="2">Partida</th>
                <th colspan="3">
                    Presupuesto
                </th>
                <th colspan="2">
                    Ejecutado
                </th>
                <th rowspan="2">Saldo</th>
            </tr>
            <tr>
                <th>Cantidad</th>
                <th>Costo Unitario</th>
                <th>PRESUPUESTO VIGENTE</th>
                <th>Cantidad</th>
                <th>PRESUPUESTO VIGENTE</th>
            </tr>
        </thead>
        <tbody>
            @php
                $suma_ejecutados = 0;
                $suma_saldos = 0;
            @endphp

            <tr>
                <td class="centreado">
                    {{ $memoria_operacion->codigo_actividad }}
                </td>
                <td>{{ $memoria_operacion->descripcion_actividad }}</td>
                <td class="centreado">{{ $memoria_operacion->partida }}</td>
                <td class="centreado">{{ $memoria_operacion->cantidad }}</td>
                <td class="centreado">{{ $memoria_operacion->costo }}</td>
                <td class="centreado">{{ $memoria_operacion->total }}</td>
                @php
                    $cantidad_usado = $o_certificacion->where('mo_id', $memoria_operacion->id)->sum('cantidad_usar');
                    $total_usado = $o_certificacion->where('mo_id', $memoria_operacion->id)->sum('presupuesto_usarse');
                    $saldo = (float) $memoria_operacion->total - (float) $total_usado;
                @endphp
                <td class="centreado">{{ $cantidad_usado }}</td>
                <td class="centreado">{{ $total_usado }}</td>
                <td class="centreado">{{ $saldo }}</td>
            </tr>

        </tbody>
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Memorias de Cálculo</title>
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

        .tabla_detalle {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    @php
        $contador = 0;
    @endphp
    @inject('configuracion', 'App\Models\Configuracion')
    @inject('o_certificacion', 'App\Models\Certificacion')
    @foreach ($formularios as $formulario)
        <img class="logo" src="{{ asset('imgs/' . $configuracion->first()->logo) }}" alt="Logo">
        <div class="titulo">MEMORIAS DE CÁLCULO<br />GESTIÓN {{ date('Y') }}</div>
        <table border="1" class="collapse">
            <tbody>
                <tr class="bg_principal">
                    <td class="bold p-5" width="10%">Código PEI:</td>
                    <td class="bold p-5">{{ $formulario->codigo_pei }}</td>
                    <td class="bold p-5" width="15%">Presupuesto programado:</td>
                    <td class="bold p-5">{{ number_format($formulario->presupuesto, 2) }}</td>
                </tr>
                <tr>
                    <td class="bold p-5">Unidad:</td>
                    <td class="bold p-5" colspan="3">{{ $formulario->unidad->nombre }}</td>
                </tr>
            </tbody>
        </table>

        <table class="tabla_detalle" border="1">
            <thead class="bg-primary">
                <tr>
                    <th class="text-center" rowspan="2">
                        Unidad Ejecutora
                    </th>
                    <th class="text-center" colspan="2">
                        Presupuestos
                    </th>
                    <th class="text-center" colspan="2">
                        POA
                    </th>
                    <th class="text-center" rowspan="2">
                        Partida de gasto
                    </th>
                    <th class="text-center" rowspan="2">
                        N°
                    </th>
                    <th class="text-center" rowspan="2">
                        Descripción
                    </th>
                    <th class="text-center" rowspan="2">
                        Cantidad Requerida
                    </th>
                    <th class="text-center" rowspan="2">
                        Unidad
                    </th>
                    <th class="text-center" rowspan="2">
                        Precio Unitario
                    </th>
                    <th class="text-center" rowspan="2">
                        Total
                    </th>
                    <th class="text-center" rowspan="2">
                        Justificación
                    </th>
                    <th class="text-center" colspan="12">
                        PROGRAMACIÓN MENSUAL
                    </th>
                    <th class="text-center" rowspan="2">
                        Total
                    </th>
                </tr>
                <tr>
                    <th class="text-center">
                        Programa
                    </th>
                    <th class="text-center">
                        Actividad
                    </th>
                    <th class="text-center">
                        Cod. Operación
                    </th>
                    <th class="text-center">
                        Cod. Act./Tarea
                    </th>
                    <th class="text-center">
                        Enero
                    </th>
                    <th class="text-center">
                        Febrero
                    </th>
                    <th class="text-center">
                        Marzo
                    </th>
                    <th class="text-center">
                        Abril
                    </th>
                    <th class="text-center">
                        Mayo
                    </th>
                    <th class="text-center">
                        Junio
                    </th>
                    <th class="text-center">
                        Julio
                    </th>
                    <th class="text-center">
                        Agosto
                    </th>
                    <th class="text-center">
                        Septiembre
                    </th>
                    <th class="text-center">
                        Octubre
                    </th>
                    <th class="text-center">
                        Noviembre
                    </th>
                    <th class="text-center">
                        Diciembre
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($formulario->memoria_calculo)
                    @foreach ($formulario->memoria_calculo->operacions as $operacion)
                        <tr v-for="item in oMemoriaCalculo.operacions">
                            <td>{{ $operacion->ue }}</td>
                            <td>{{ $operacion->prog }}</td>
                            <td>{{ $operacion->act }}</td>
                            <td>
                                {{ $operacion->codigo_operacion }}
                            </td>
                            <td>
                                {{ $operacion->codigo_actividad }}
                            </td>
                            <td>{{ $operacion->partida }}</td>
                            <td>{{ $operacion->nro }}</td>
                            <td>{{ $operacion->descripcion }}</td>
                            <td>{{ $operacion->cantidad }}</td>
                            <td>{{ $operacion->unidad }}</td>
                            <td>{{ $operacion->costo }}</td>
                            <td>{{ $operacion->total }}</td>
                            <td>
                                {{ $operacion->justificacion }}
                            </td>
                            <td>{{ $operacion->ene }}</td>
                            <td>{{ $operacion->feb }}</td>
                            <td>{{ $operacion->mar }}</td>
                            <td>{{ $operacion->abr }}</td>
                            <td>{{ $operacion->may }}</td>
                            <td>{{ $operacion->jun }}</td>
                            <td>{{ $operacion->jul }}</td>
                            <td>{{ $operacion->ago }}</td>
                            <td>{{ $operacion->sep }}</td>
                            <td>{{ $operacion->oct }}</td>
                            <td>{{ $operacion->nov }}</td>
                            <td>{{ $operacion->dic }}</td>
                            <td>
                                {{ $operacion->total_operacion }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="8" class="text-center">TOTAL PARTIDA</th>
                        <th colspan="3"></th>
                        <th>
                            {{ $formulario->memoria_calculo->total_actividades }}
                        </th>
                        <th></th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_ene }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_feb }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_mar }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_abr }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_may }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_jun }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_jul }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_ago }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_sep }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_oct }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_nov }}</th>
                        <th class="text-center">{{ $formulario->memoria_calculo->total_dic }}</th>
                        <th class="text-center">
                            {{ $formulario->memoria_calculo->total_final }}
                        </th>
                    </tr>
                @else
                    <tr>
                        <td colspan="26" class="centreado">NO SE ENCONTRARON REGISTROS</td>
                    </tr>
                @endif
            </tbody>
        </table>
        @php
            $contador++;
        @endphp
        @if ($contador < count($formularios))
            <div class="salto_linea"></div>
        @endif
    @endforeach
</body>

</html>

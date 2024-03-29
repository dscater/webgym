<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Empleados</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th,
        tbody tr td {
            font-size: 0.63em;
            word-wrap: break-word;
        }

        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            width: 200px;
            height: 90px;
            top: -20px;
            left: -20px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.55em;
        }

        table tbody tr td.franco {
            background: red;
            color: white;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .p_cump {
            color: red;
            font-size: 1.2em;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .green {
            background: #28a745;
            color: white;
        }

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }
    </style>
</head>

<body>
    @inject('configuracion', 'App\Models\Configuracion')
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . $configuracion->first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ $configuracion->first()->razon_social }}
        </h2>
        <h4 class="texto">LISTA DE EMPLEADOS</h4>
        <h4 class="fecha">Expedido: {{ date('d-m-Y') }}</h4>
    </div>
    <table border="1">
        <thead class="green">
            <tr>
                <th width="3%">N°</th>
                <th width="5%">Foto</th>
                <th>NOMBRE</th>
                <th>AP. PATERNO</th>
                <th>AP. MATERNO</th>
                <th>C.I.</th>
                <th>DIRECCIÓN</th>
                <th>TELÉFONO</th>
                <th>TELÉFONO DE REFERENCIA</th>
                <th>CORREO</th>
                <th>FECHA DE INICIO CONTRATO</th>
                <th>CARGO</th>
                <th>SALARIO</th>
                <th>HORARIO</th>
                <th>SUCURSAL</th>
                <th width="9%">FECHA DE REGISTRO</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach ($empleados as $empleado)
                <tr>
                    <td class="centreado">{{ $cont++ }}</td>
                    <td class="img_celda"><img src="{{ asset('imgs/empleados/' . $empleado->foto) }}" alt="Foto"></td>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->paterno }}</td>
                    <td>{{ $empleado->materno }}</td>
                    <td>{{ $empleado->full_ci }}</td>
                    <td>{{ $empleado->dir }}</td>
                    <td>{{ $empleado->fono }}</td>
                    <td>{{ $empleado->fono_referencia }}</td>
                    <td>{{ $empleado->correo }}</td>
                    <td>{{ $empleado->fecha_inicio }}</td>
                    <td>{{ $empleado->cargo }}</td>
                    <td>{{ $empleado->salario }}</td>
                    <td>{{ $empleado->horario }}</td>
                    <td>{{ $empleado->sucursal->nombre }}</td>
                    <td>{{ $empleado->fecha_registro }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

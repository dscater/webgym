<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>IngresoProductos</title>
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

        .img_celda img {
            width: 45px;
        }

        .bold{
            font-weight: bold;
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
        <h4 class="texto">LISTA DE INGRESOS DE PRODUCTOS</h4>
        <h4 class="fecha">Expedido: {{ date('d-m-Y') }}</h4>
    </div>
    <table border="1">
        <thead class="green">
            <tr>
                <th width="9%">FECHA INGRESO</th>
                <th>PRODUCTO</th>
                <th>CATEGORÍA</th>
                <th>SUCURSAL</th>
                <th>CANTIDAD</th>
                <th width="9%">FECHA DE VENCIMIENTO</th>
                <th width="9%">FECHA DE REGISTRO</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($ingreso_productos as $ingreso_producto)
                <tr>
                    <td class="centreado">{{ $ingreso_producto->fecha_ingreso }}</td>
                    <td class="centreado">{{ $ingreso_producto->producto->nombre }}</td>
                    <td class="centreado">{{ $ingreso_producto->producto->categoria->nombre }}</td>
                    <td class="centreado">{{ $ingreso_producto->sucursal->nombre }}</td>
                    <td class="centreado">{{ $ingreso_producto->cantidad }}</td>
                    <td class="centreado">{{ $ingreso_producto->fecha_vencimiento }}</td>
                    <td class="centreado">{{ $ingreso_producto->fecha_registro }}</td>
                </tr>
                @php
                    $total += (float) $ingreso_producto->cantidad;
                @endphp
            @endforeach
            <tr>
                <td colspan="4" class="total">TOTAL</td>
                <td class="bold centreado">{{ $total }}</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>

</html>

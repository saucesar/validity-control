<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roteiro - PDF</title>
</head>
<body>
    <style>
        .text-center {
            text-align: center;
        }
        table {
            width: 100%;
        }
        td, th, thead {
            padding: 5px;
            text-align: left;
            height: 70px;
        }
        td {
            border-left: 2px solid #ddd;
            border-right: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
            border-top: 2px solid #ddd;
        }
        th {
            background-color: gray;
        }
    </style>
    <table>
        <thead>
            <th>Produto</th>
            <th>Validade</th>
            <th>Lote</th>
            <th>Quant.Atual</th>
            <th>Contagem</th>
        </thead>
        <tbody>
        @foreach($expdates as $expdate)
        <tr>
            <td>{{ $expdate->product->description }}</td>
            <td class="text-center">{{ $expdate->date() }}</td>
            <td>{{ $expdate->lote }}</td>
            <td class="text-center">{{ $expdate->amount }}</td>
            <td></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</body>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>
<body>
    <style>
        .table {
            width: 100%;
        }
        .td, .th, .thead{
            border-bottom: 2px solid #ddd;
            padding: 5px;
            text-align: left;
            height: 200px;
        }
        .th{
            background-color: gray;
        }
    </style>
    <div>
        <h1>Produtos</h1>
        <table class="table">
            <thead class="thead">
                <th class="th">Codigo</th>
                <th class="th">Descrição</th>
                <th class="th">Validade / Quantidade</th>
            </thead>
            <tbody >
            @foreach($products as $product)
                @if(count($product->expirationDates) > 0)
                <tr>
                    <td class="td">{{ $product->barcode }}</td>
                    <td class="td">{{ $product->description }}</td>
                    <td class="td">
                        @foreach($product->expirationDates as $expdate)
                            {{ $expdate->date }} / {{ $expdate->amount }}<br>
                        @endforeach
                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
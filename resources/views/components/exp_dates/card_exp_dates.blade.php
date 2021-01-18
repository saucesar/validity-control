<div class="card min-card-width mb-5 shadow">
    <div class="card-header {{ isset($danger) ? 'text-danger' : 'text-warning' }}">
        @if(isset($danger))
        <i class="fas fa-exclamation-triangle"></i>
        @else
        <i class="fas fa-exclamation-circle"></i>
        @endif
        <b>{{ $title ?? '' }}</b>
    </div>
    <div class="card-body">
        <table class="table critical-date-table">
            <thead>
                <th>#</th>
                <th>Data</th>
                <th>Quantidade</th>
                <th>Produto</th>
            </thead>
            <tbody>
                @foreach($dates as $key => $date)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $date->date() }}</td>
                    <td>{{ $date->amount }}</td>
                    <td><a href="{{ route('products.show', $date->product->id) }}">{{ $date->product->description }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        Total de itens: {{ count($dates) }}
    </div>
</div>
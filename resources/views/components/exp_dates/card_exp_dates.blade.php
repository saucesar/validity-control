<div class="card card-body min-card-width">
    <div class="row">
        <div class="col">
            <small><b>{{ $title ?? '' }}</b></small>
        </div>
    </div>
    <table class="table critical-date-table">
        <thead>
            <th>Data</th>
            <th>Quantidade</th>
            <th>Produto</th>
        </thead>
        <tbody>
            @foreach($dates as $date)
            <tr>
                <td>{{ $date->date }}</td>
                <td>{{ $date->amount }}</td>
                <td><a href="{{ route('products.show', $date->product->id) }}">{{ $date->product->description }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
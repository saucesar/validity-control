<table class="table table-hover table-borderless text-center {{ $table_historic_class ?? '' }}">
    <thead>
        <th>
            <i class="far fa-calendar-alt"></i>
            Data
        </th>
        <th>
            <i class="fas fa-boxes"></i>
            Quantidade
        </th>
        <th>
            <i class="fas fa-pallet"></i>
            Lote
        </th>
        <th>
            @if(!isset($table_historic_class))
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalAddDate{{ $product->id }}"
                title="Adicionar uma data">
                <i class="fas fa-plus-circle"></i>
            </button>
            @endif
        </th>
    </thead>
    <tbody>
        @foreach($dates as $expdate)
        <tr>
            <td>{{ $expdate->date }}</td>
            <td>{{ $expdate->amount }}</td>
            <td>{{ $expdate->lote }}</td>
            <td>
                <form action="{{ route('product.removeDate', $expdate) }}" method="post">
                    @csrf
                    @method('delete')

                    <button type="submit" style="zoom: 60%;" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Deseja remover?');" title="remover {{ $expdate->date }} ?">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
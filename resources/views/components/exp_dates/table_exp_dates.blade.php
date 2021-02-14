<table class="table table-hover text-center zoom-80 {{ $table_historic_class ?? '' }}">
    <thead>
        <th>
            <i class="far fa-calendar-alt" title="Data de validade"></i>
        </th>
        @if(!isset($is_historic))
        <th>
            <i class="far fa-clock" title="Dias Restantes"></i>
        </th>
        @endif
        <th>
            <i class="fas fa-boxes" title="Quantidade"></i>
        </th>
        <th>
            <i class="fas fa-pallet" title="Lote"></i>
        </th>
        @if(auth()->user()->isCompanyOwner())
        <th>
            <i class="fas fa-user" title="Adicionado por..."></i>
        </th>
        @endif
        <th>
            @if(!isset($is_historic))
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalAddDate{{ $product->id }}"
                title="Adicionar uma data">
                <i class="fas fa-plus-circle"></i>
            </button>
            @endif
        </th>
    </thead>
    <tbody>
        @foreach($dates as $expdate)
        <tr class="{{ $expdate->daysToExpire() <=3 && !isset($is_historic) ? 'border border-danger text-danger' : '' }}">
            <td>{{ $expdate->date() }}</td>
            @if(!isset($is_historic))
            <td>{{ $expdate->daysToExpire() }}</td>
            @endif
            <td>{{ $expdate->amount }}</td>
            <td>{{ $expdate->lote }}</td>
            @if(auth()->user()->isCompanyOwner())
            <td>{{ $expdate->addedBy->firstName() }}</td>
            @endif
            <td>
            @if(!isset($is_historic))
                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalEditDate{{ $expdate->id }}">
                        <i class="fas fa-pen"></i>
                    </button>
                    <form action="{{ route('product.removeDate', $expdate) }}" method="post">
                        @csrf
                        @if(isset($searchData))
                            <input type="hidden" name="redirect" value="products.index">
                        @endif
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger"onclick="return confirm('Deseja remover?');"
                                title="remover {{ $expdate->date }} ?">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endif
            </td>
        </tr>
        @include('components.exp_dates.modal_edit_date', ['expdate' => $expdate])
        @endforeach
    </tbody>
</table>
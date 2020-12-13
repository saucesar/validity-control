<div class="card mb-2">
    <div class="card-body row d-flex justify-content-between">
        <div class="col">
            <h5 class="card-title" title="Detalhes do produto"><a href="{{ route('products.show', $product) }}">{{ $product->description }}</a></h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $product->barcode }}</h6>
        </div>
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseproduct{{ $product->id }}" aria-expanded="false"
                title="Exibir datas.">
            <i class="far fa-caret-square-down"></i>
            Mostrar
        </button>
    </div>
    <div class="collapse multi-collapse {{ $collapse_class ?? '' }}" id="collapseproduct{{ $product->id }}">
        <table class="table table-hover table-borderless text-center">
            <thead>
                <th>Data</th>
                <th>Quantidade</th>
                <th>Lote</th>
                <th>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalAddDate{{ $product->id }}"
                            title="Adicionar uma data">
                        <i class="fas fa-plus-circle"></i>
                        Adicionar
                    </button>
                </th>
            </thead>
            <tbody>
                @foreach($product->expirationDates as $expdate)
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
    </div>
</div>
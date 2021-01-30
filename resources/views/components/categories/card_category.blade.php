<div class="card min-card-width-2x mb-4">
    <div class="card-header">
        <h5 class="card-title">
            <i class="fas fa-cube"></i>
            {{ $category->name }}
        </h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <p>
                    <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseProducts{{ $category->id }}" aria-expanded="false">
                        <i class="fas fa-cubes"></i>
                        Total de Produtos: {{ count($category->products) }}
                    </button>
                </p>
                <div class="collapse" id="collapseProducts{{ $category->id }}">
                    <table class="table table-hover">
                        <tbody>
                            @foreach($category->products as $product)
                            <tr>
                                <td>{{ $product->barcode }}</td>
                                <td><a href="{{ route('products.show', $product) }}">{{ $product->description }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
            <li class="list-group-item">
                <p title="Produtos desta categoria serão enviados para este(s) email(s).">
                    <i class="far fa-envelope"></i>
                    Enviar para:
                </p>
                <ul>
                    @foreach($category->send_to as $email)
                    <li>{{ $email }}</li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    <div class="card-footer">
        Ultima atualização: {{ $category->updated_at }}
    </div>
</div>
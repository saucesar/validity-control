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
                    <a  class="btn btn-sm btn-outline-primary"  class="btn btn-sm btn-outline-primary" href="{{ route('products.byCategory', $category->id) }}">
                        <i class="fas fa-cubes"></i>
                        Total de Produtos: {{ count($category->products) }}
                    </a>
                </p>
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